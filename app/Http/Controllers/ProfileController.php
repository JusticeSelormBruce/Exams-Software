<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function savepass(Request $request)
    {
        $user = User::where(['id' =>$request->user_id])->first();

        if (Hash::check($request->oldpassword, $user->password)) {
            if ($request->newpassword == $request->confirmpassword) {
                $user->update(['password' => Hash::make($request->newpassword)]);
                return back()->with('success', 'Password Updated Successfully');
            }
            return back()->with('warning', 'New Password does not match');
        }
        return back()->with('warning', 'Old Password not Valid');
    }
}
