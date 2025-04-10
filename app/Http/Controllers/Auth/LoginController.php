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
        $user = Auth::user();

        if ($user == null) {
            return view(view: 'auth.login');
        }

        if ($user->role === 'Administrator') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'Staff') {
            return redirect('/staff/dashboard');
        } else {
            return view(view: 'auth.login');
        }
    }

    public function login(Request $request)
    {
        $remember = !empty($request->inputRememberMe) ? true : false;
        if (Auth::attempt(['email' => $request->inputEmail, 'password' => $request->inputPassword], $remember)) {

            $user = Auth::user();

            if ($user->role === 'Administrator') {
                return redirect()->route('admin.index');
            } elseif ($user->role === 'Staff') {
                if ($user->office_id === Null) {
                    Auth::logout();
                    return redirect()->back()->with('error', "No Assigned Office, Please contact administrator!");
                }
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
