<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $remember = !empty($request->inputRememberMe) ? true : false;
        if (Auth::attempt(['email' => $request->inputEmail, 'password' => $request->inputPassword], $remember)) {

            $user = Auth::user();

            if ($user->role === 'Administrator') {
                return redirect()->route('admin.index');
            } elseif ($user->role === 'Staff') {
                return redirect()->route('staff.index');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', "Unathorized Access");
            }
        } else {
            return redirect()->back()->with('error', "Please enter correct email and password");
        }
    }
}
