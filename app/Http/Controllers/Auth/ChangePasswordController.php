<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            return response()->json([
                'success' => false,
                'message' => 'Old password did not match our record.',
            ]);
        }

        $user->password = Hash::make($request->new_password);
        if ($user->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update password.',
            ]);
        }
    }
}