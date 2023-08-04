<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class SessionsController extends Controller
{
    public function create(): View
    {
        return view("sessions.create");
    }

    public function store(): Response
    {
        $attributes = request()->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (auth()->attempt($attributes) === false) {
            throw ValidationException::withMessages([
                "email" => "Your provided credentials could not be verified."
            ]);
        }

        session()->regenerate();

        return redirect("/")->with("success", "Welcome Back!");
    }

    public function destroy(): Response
    {
        auth()->logout();

        return redirect("/")->with("success", "Goodbye!");
    }
}
