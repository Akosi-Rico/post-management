<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Manage\Comment;
use App\Models\Manage\Post;

class AccountController extends Controller
{
    public function index()
    {
        $data = [
            "personalPost" => Post::viewAllPersonalPost(Post::IS_ACTIVE, auth()->user()->id),
        ];

       return view("modules.page.account.profile", compact("data"));
    }

    public function store()
    {
        return Post::createOrUpdatePost(request()->all());
    }

    public function update()
    {
       return Post::createOrUpdatePost(request()->all());
    }

    public function destroy()
    {
        return Post::canRemovePost(request()->all());
    }

    public function canCreateOrUpdateComment()
    {
        return Comment::createOrUpdateComment(request()->all());
    }

    public function canDeleteComment()
    {
        return Comment::canRemoveComment(request()->all());
    }

    public function canFilterPost() 
    {   
        if (!in_array(request()->status, Post::ALLOWED_STATUS)) {
            return false;
        }

        return response()->json(Post::viewAllPersonalPost(request()->status, auth()->user()->id));
    }

    public function canRatePost()
    {
       return Post::canRate(request()->all());
    }
}
