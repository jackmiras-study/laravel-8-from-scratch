<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Newsletter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate(["email" => "required|email"]);

        try {
            resolve(Newsletter::class)->subscribe(request("email"));
        } catch (Exception $exception) {
            throw ValidationException::withMessages([
                "email" => "This email could not be added to our newsletter list."
            ]);
        }

        return redirect("/")->with("You are now signed up for our newsletter");
    }
}
