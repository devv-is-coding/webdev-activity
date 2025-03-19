<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLoginForm() {
        if(Session::has('loginId')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function showRegisterForm() {    
        return view('auth.register');
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credentials = User::where('email', $request->email)->first();
        if ($credentials && Hash::check($request->password, $credentials->password)) {
            Auth::login($credentials);
            Session::put('loginId', $credentials->id); {
            Session::regenerate();
            return redirect()->route('dashboard')->with('success', 'Logged in successfully');
        }
        return back()->with('error', 'Invalid credentials');
    }
}
    public function register(Request $request){
        if(Session::has('loginId')) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('login')->with('success', 'Account created successfully');
    }
    public function logout(Request $request)
{
    if (Session::has('loginId')) {
        Auth::logout();
        Session::pull('loginId');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
    return redirect()->route('login')->with('error', 'You are not logged in');
}
}

