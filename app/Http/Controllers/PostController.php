<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function store(Request $request): Response
    {
        $attributes = $request->validate([
            "title" => "required",
            "thumbnail" => "required",
            "slug" => "required|unique:posts,slug",
            "excerpt" => "required",
            "body" => "required",
            "category_id" => "required|exists:categories,id",
        ]);

        $attributes["user_id"] = auth()->id();
        $attributes["thumbnail"] = $request->file("thumbnail")->store("thumbnails");

        Post::create($attributes);

        return redirect("/");
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
