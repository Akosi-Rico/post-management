<?php

namespace App\Models\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Manage\Comment;
use App\Models\Manage\PostRating;
class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    const IS_ACTIVE = 1;
    const IS_INACTIVE = 0;

    const ALLOWED_STATUS = [
        self::IS_ACTIVE,
        self::IS_INACTIVE,
    ];

    public static function viewAllPersonalPost($status = 1, $userId = null)
    {
        $posts = self::select(
                    "posts.id",
                    "posts.message",
                    "posts.status",
                    "created_user_id",
                    "u.name",
                    "posts.created_at",
                    "posts.updated_at"
                )
                ->join("users as u", "u.id", "posts.created_user_id")
                ->orderBy("posts.created_at", "desc")
                ->where("status", "=", $status)
                ->with("comments", "rate");

            if (!empty($userId)) {
                $posts = $posts->where("created_user_id", $userId);
            }

            return $posts->get()->map(function($item) {
                if (!empty($item)) {
                    $item->isEdited = false;
                    $item->postedDate = now()->parse($item->created_at)->diffForHumans();
                    if ($item->created_at != $item->updated_at) {
                        $item->isEdited = true;
                        $item->postedDate = now()->parse($item->updated_at)->diffForHumans();
                        $item->archive = false;
                    }

                    $item->oneStartCount = $item->rate->where("rating", PostRating::RATE_ONE)->count();
                    $item->twoStartCount = $item->rate->where("rating", PostRating::RATE_TWO)->count();
                    $item->threeStartCount = $item->rate->where("rating", PostRating::RATE_THREE)->count();
                    $item->fourStartCount = $item->rate->where("rating", PostRating::RATE_FOUR)->count();
                    $item->fiveStartCount = $item->rate->where("rating", PostRating::RATE_FIVE)->count();

                    return $item;
                }
            });
    }

    public function comments(): HasMany 
    {
        return $this->hasMany(Comment::class, "post_id", "id")
            ->select(
                "comments.id", 
                "comments.post_id", 
                "comments.posted_user_id",
                "comments.created_at",
                "comments.message as mainComment"
            );
    }

    public function rate(): HasMany
    {
        return $this->hasMany(PostRating::class, "post_id", "id")
            ->select(
                "post_ratings.id", 
                "post_ratings.post_id",
                "post_ratings.user_id",
                "post_ratings.rating"
            );
    }

    public static function createOrUpdatePost($data)
    {
        if (empty($data["payload"]["message"])) {
            return false;
        }

        try {
            DB::beginTransaction();

            $post = self::updateOrCreate(["id" => $data["payload"]["id"], "created_user_id" => auth()->user()->id], [
                "message" => $data["payload"]["message"],
                "created_user_id" => auth()->user()->id,
                "status" => (!empty($data["payload"]["archive"]) ? self::IS_INACTIVE : self::IS_ACTIVE)
            ]);

            DB::commit();
            return response()->json($post, Response::HTTP_OK);
        } catch(\Throwable $th) {
            DB::rollback();
            throw new \Exception($th);
        }
    }

    public static function canRemovePost($data)
    {
        if (empty($data["payload"]["message"])) {
            return false;
        }

        try {
            DB::beginTransaction();

            $post = self::where("id", $data["payload"]["id"])->first();
            if (!empty($post)) {
                $post->delete();
            }

            DB::commit();
            return response()->json(["id" => $post->id, "message" => "Successfully Deleted!"], Response::HTTP_OK);
        } catch(\Throwable $th) {
            DB::rollback();
            throw new \Exception($th);
        }
    }

    public static function canRate($data)
    {
        if (empty($data)) {
            return false;
        }

        try {
            DB::beginTransaction();

            $rate = PostRating::updateOrCreate(["post_id" => $data["postId"], "user_id" => auth()->user()->id], [
                "rating" => $data["rate"],
                "user_id" => auth()->user()->id
            ]);

            DB::commit();
            return response()->json($rate, Response::HTTP_OK);
        } catch(\Throwable $th) {
            DB::rollback();
            throw new \Exception($th);
        }
    }
}
