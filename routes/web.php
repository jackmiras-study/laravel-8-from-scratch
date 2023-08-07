<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use MailchimpMarketing\ApiClient;

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

Route::post("newsletter", function() {
    request()->validate(["email" => "required|email"]);

    $mailchimp = new ApiClient();

    $mailchimp->setConfig([
        "apiKey" => config("services.mailchimp.key"),
        "server" => "us21",
    ]);

    try {
        $mailchimp->lists->addListMember("520e1ec5e1", [
            "email_address" => request("email"),
            "status" => "subscribed",
        ]);
    } catch (Exception $exception) {
        throw ValidationException::withMessages([
            "email" => "This email could not be added to our newsletter list."
        ]);
    }

    return redirect("/")->with("You are now signed up for our newsletter");
});

Route::get("/", "PostController@index")->name("home");

Route::get("posts/{post:slug}", "PostController@show");
Route::post("posts/{post:slug}/comments", "PostCommentsController@store");

Route::get("register", "RegisterController@create")->middleware("guest");
Route::post("register", "RegisterController@store")->middleware("guest");

Route::get("login", "SessionsController@create")->middleware("guest");
Route::post("login", "SessionsController@store")->middleware("guest");

Route::post("logout", "SessionsController@destroy")->middleware("auth");
