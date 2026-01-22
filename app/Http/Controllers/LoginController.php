<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function halamanlogin(){
        return view('login_aplikasi');
    }

    public function postlogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }
        return redirect('/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
