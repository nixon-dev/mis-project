<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function user_update_password(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $oldPasswordInput = $request->input('old_password');
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Error: Old password did not match our record.');
        }

        $user->password = Hash::make($request->new_password);
        if ($user->save()) {
            Auth::logout();
            return redirect(url('/login'))->with('success', 'Password updated successfully. Please Log in with your new password');
        } else {
            return redirect()->back()->with('error', 'Error: Failed to update password.');
        }
    }
}
