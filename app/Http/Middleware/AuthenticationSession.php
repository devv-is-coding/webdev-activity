<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AuthenticationSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!Session::has('loginId')) {
            if(Auth::check()) {
                Session::put('loginId', Auth::user()->id);
            } else {
                return redirect('/login')->with('error', 'Please login first');
            }
        }
        return $next($request);
    }

}

