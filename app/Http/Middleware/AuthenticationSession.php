<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AuthenticationSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()) {
            return redirect()-> route('login')->with('error', 'You must be logged in first.');
        }
        return $next($request);
    }
}
