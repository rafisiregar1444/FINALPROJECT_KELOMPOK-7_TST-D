<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyelenggaraController extends Controller
{
    public function index(){
        $penyelenggara = 'List Penyelenggara';
        return view('penyelenggara.index', ['penyelenggara' => $penyelenggara]);
    }

    public function create(){
        return view('penyelenggara.create');
    }

    public function list(){
        return view('penyelenggara.list');

    }
}