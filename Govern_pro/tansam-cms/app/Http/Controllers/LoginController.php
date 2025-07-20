<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Check with hashed pass
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        else {
            return redirect()->back()->withErrors('Invalid Credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm');
    }
}
