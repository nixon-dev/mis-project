<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->inputRememberMe) ? true : false;
        if (Auth::attempt(['email' => $request->inputEmail, 'password' => $request->inputPassword], $remember)) {
            return redirect('main.app');
        } else {
            return redirect()->back()->with('error', "Please enter correct email and password");
        }
    }
}
