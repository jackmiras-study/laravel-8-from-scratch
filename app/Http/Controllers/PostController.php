<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        return view("posts", [
            "posts" => Post::latest()->filter($request->only('search'))->get(),
            "categories" => Category::all(),
        ]);
    }

    public function show(Post $post): View
    {
        return view("post", [
            "post" => $post,
        ]);
    }
}
