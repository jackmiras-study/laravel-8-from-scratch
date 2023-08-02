<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        return view("posts.index", [
            "posts" => Post::latest()->filter($request->only('search'))->get(),
        ]);
    }

    public function show(Post $post): View
    {
        return view("posts.show", [
            "post" => $post,
        ]);
    }
}
