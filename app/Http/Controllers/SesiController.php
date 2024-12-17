<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }
    function login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'remember'=>'required'
        ],[
            'username.required'=>'Username wajib diisi',
            'password.required'=>'Password wajib diisi'
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
            'remember' => $request->remember_token,
            'last_login' =>  Carbon::now()->toDateTimeString(),
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'admin'){
                return redirect('/home');
            }
            elseif(Auth::user()->role == 'user'){
                return redirect('/home');
            }
        } else {
            return redirect('/login')->withErrors('Username atau password salah')->withInput();
        };
    }
    function logout(){
        Auth::logout();
        return redirect('login');
    }


}
