<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view("register.create");
    }

    public function store(Request $request): Response
    {
        $attributes = $request->validate([
            "name" => "required|max:255",
            "username" => "required|max:255|min:3",
            "email" => "required|email|max:255",
            "password" => "required|max:255|min:8",
        ]);

        User::create($attributes);

        return redirect("/");
    }
}
