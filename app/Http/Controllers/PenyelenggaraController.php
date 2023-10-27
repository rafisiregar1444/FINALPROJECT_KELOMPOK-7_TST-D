<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = DB::table('tbl_yayasan_pts')
            ->join('tbl_perguruan_tinggi', 'tbl_perguruan_tinggi.id_bp_pts', '=', 'tbl_yayasan_pts.id_yys_pt')
            ->paginate(10);

        return view('penyelenggara.list')->with('data', $data);

    }
}