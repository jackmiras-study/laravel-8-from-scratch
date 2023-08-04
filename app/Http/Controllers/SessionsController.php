<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class SessionsController extends Controller
{
    public function destroy(): Response
    {
        auth()->logout();

        return redirect("/")->with("success", "Goodbye!");
    }
}
