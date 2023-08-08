<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        return view("posts.index", [
            "posts" => Post::latest()
                ->filter($request->all())
                ->paginate(6)
                ->withQueryString(),
        ]);
    }

    public function show(Post $post): View
    {
        return view("posts.show", [
            "post" => $post,
        ]);
    }

    public function create(): View
    {
        return view("posts.create");
    }
}
