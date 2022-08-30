<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authLogin(LoginRequest $request) {

        //encrypt password
        $user = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::attempt($user, $request->remember)){
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', "Login User Failed!!");
    }

    public function authLogout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Logout Success');
    }
}
