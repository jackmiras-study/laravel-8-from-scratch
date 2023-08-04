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
            "username" => "required|unique:users,username|min:3|max:255",
            "email" => "required|unique:users,email|email|max:255",
            "password" => "required|min:8|max:255",
        ]);

        User::create($attributes);

        return redirect("/");
    }
}
