<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", "PostController@index")->name("home");
Route::get("posts/{post:slug}", "PostController@show");

Route::get("authors/{author:username}", function (User $author) {
    return view("posts", [
        "posts" => $author->posts,
        "categories" => Category::all(),
    ]);
});
