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

    public function register()
    {
       

    }

    public function login(Request $request)
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
}
