<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(){
        return view('dashboard');
    }

    function admin(){
        return view('dashboard');
    }

    function user(){
        return view('dashboard');
    }

    function test(){
        return view('layouts.template');
    }
    function roledashboard(){
        return view('roledashboard');
    }
    
}
