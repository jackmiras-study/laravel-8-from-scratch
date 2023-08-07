<?php

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
Route::post("posts/{post:slug}/comments", "PostCommentsController@store");

Route::get("register", "RegisterController@create")->middleware("guest");
Route::post("register", "RegisterController@store")->middleware("guest");

Route::get("login", "SessionsController@create")->middleware("guest");
Route::post("login", "SessionsController@store")->middleware("guest");

Route::post("logout", "SessionsController@destroy")->middleware("auth");
