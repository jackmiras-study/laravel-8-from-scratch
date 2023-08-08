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
        Post::create(array_merge($this->validatePost(), [
            "user_id" => auth()->id(),
            "thumbnail" => $request->file("thumbnail")->store("thumbnails"),
        ]));

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
        $post = Post::find($request->id);
        $attributes = $this->validatePost($post);

        if ($attributes["thumbnail"] ?? false) {
            $attributes["thumbnail"] = $request->file("thumbnail")->store("thumbnails");
        }

        $post->update($attributes);

        return back()->with("success", "Post Updated");
    }

    public function destroy(Request $request): Response
    {
        Post::find($request->id)->delete();

        return back()->with("success", "Post Deleted");
    }

    private function validatePost(Post $post = new Post()): array
    {
        return request()->validate([
            "title" => "required",
            "thumbnail" => $post->exists ? "image" : "required|image",
            "slug" => $post->exists ? "required" : "required|unique:posts,slug",
            "excerpt" => "required",
            "body" => "required",
            "category_id" => "required|exists:categories,id",
        ]);

    }
}
