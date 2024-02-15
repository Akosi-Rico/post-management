<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Manage\Post;

class ClientPostController extends Controller
{
    public function index()
    {
        $data = [
            "personalPost" => Post::viewAllPersonalPost(Post::IS_ACTIVE),
        ];

       return view("modules.page.client.post", compact("data"));
    }
}
