<?php

namespace App\Models\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Throw_;
use Symfony\Component\HttpFoundation\Response;

class Comment extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public static function viewAllComments()
    {
        return self::select(
                "id",
                "post_id",
                "posted_user_id",
                "parent_id",
                "message",
            )
            ->orderBy("id", "desc")
            ->get()->map(function($item){
                if (!empty($item)) {
                    $item->isEdited = false;
                    $item->postedDate = now()->parse($item->created_at)->diffForHumans();
                    if ($item->created_at != $item->updated_at) {
                        $item->isEdited = true;
                        $item->postedDate = now()->parse($item->updated_at)->diffForHumans();
                    }

                    return $item;
                }
            });
    }

    public function replies()
    {
        return $this->hasMany(self::class, "parent_id", "id");
    }
    
    public static function createOrUpdateComment($data)
    {
        if (empty($data["payload"]["postId"])) {
            return false;
        }

        try {
            DB::beginTransaction();

            $comment = self::updateOrCreate([
                "id" => $data["payload"]["id"], 
                "post_id" => $data["payload"]["postId"], 
                "posted_user_id" => auth()->user()->id], [
                    "parent_id" => 0,
                    "posted_user_id" => auth()->user()->id,
                    "message" => $data["payload"]["message"]
                ]);
    
            DB::commit();
            return response()->json($comment, Response::HTTP_OK);
        } catch(\Throwable $th) {
            DB::rollback();
            Throw new \Exception($th);
        }
    }

    public static function canRemoveComment($data)
    {
        if (empty($data["payload"]["id"])) {
            return false;
        }

        try {
            DB::beginTransaction();

            $comment = self::where("id", $data["payload"]["id"])->first();
            if (!empty($comment)) {
                $comment->delete();
            }

            DB::commit();
            return response()->json(["id" => $comment->id, "message" => "Successfully Deleted!"], Response::HTTP_OK);
        } catch(\Throwable $th) {
            DB::rollback();
            Throw new \Exception($th);
        }
    }
}
