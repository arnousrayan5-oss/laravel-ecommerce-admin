<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    function login(Request $request){
        $fields = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($fields)){
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Wrong email or password');
    }

    function loginPage(){
        return view('auth.login');
    }

    function registerPage(){
        return view('auth.register');
    }

    function register(Request $request){
        $fields = $request->validate([
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required', 'between:8,64'],
            'name' => ['required', 'min:3', 'max:255'],
            'terms' => ['required']
        ]);

        $user = User::create($fields);
        Auth::login($user);
        return redirect()->route('home');
    }
}
