<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }
    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'admin'){
                return redirect('/dashboard');
            }
            elseif(Auth::user()->role == 'user'){
                return redirect('/dashboard');
            }
        } else {
            return redirect('')->withErrors('Username atau password salah')->withInput();
        };
    }
    function logout(){
        Auth::logout();
        return redirect('');
    }
}
