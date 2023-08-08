<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->username !== "jackmiras") {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
