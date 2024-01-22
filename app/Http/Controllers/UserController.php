<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return inertia('User/Login');
    }


    public function verifyLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable|boolean'
        ]);

        // $user = User::where('email', $request->email)->first();
        // if ($user) {
        //     $encryptedPassword = $user->password;
        //     $checkPassword = Hash::check($request->password, $encryptedPassword);
        //     if ($checkPassword) {
        //         // login here
        //         Auth::login($user, $request->remember);
        //         $request->session()->regenerate();

        //         return redirect()->to('/dashboard');
        //     }
        // }
        $adminUser = AdminUser::where('email', $request->email)->first();
        if ($adminUser) {
            $encryptedPassword = $adminUser->password;
            $checkPassword = Hash::check($request->password, $encryptedPassword);
            if ($checkPassword) {
                // login here
                Auth::guard('admin')->login($adminUser, $request->remember);
                $request->session()->regenerate();

                return redirect()->to('/is-admin');
            }
        }
    }
}
