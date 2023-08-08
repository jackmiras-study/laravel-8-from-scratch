<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPostController extends Controller
{

    public function index(): View
    {
        return view("admin.posts.index", [
            "posts" => Post::paginate(50),
        ]);
    }

    public function create(): View
    {
        return view("admin.posts.create");
    }

    public function store(Request $request): Response
    {
        $attributes = $request->validate([
            "title" => "required",
            "thumbnail" => "required|image",
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

    public function edit(Post $post): View
    {
        return view("admin.posts.edit", [
            "post" => $post,
        ]);
    }

    public function update(Request $request): Response
    {
        $attributes = $request->validate([
            "title" => "required",
            "thumbnail" => "image",
            "slug" => "required",
            "excerpt" => "required",
            "body" => "required",
            "category_id" => "required|exists:categories,id",
        ]);

        Post::find($request->id)->update($attributes);

        return back()->with("success", "Post Updated");
    }

    public function destroy(Request $request): Response
    {
        Post::find($request->id)->delete();

        return back()->with("success", "Post Deleted");
    }
}
