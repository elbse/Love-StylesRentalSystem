<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');

    }

    public function showLogin()
    {
        return view('auth.login');

    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        $user = User::create($validate);

        Auth::login($user);

        return redirect()->route('dashboard');

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // prevent session fixation
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('show.login');
    }
}
