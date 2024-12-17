<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsideController extends Controller
{
    public function showAside()
    {
        // Anda bisa menetapkan nilai pengembang dari sumber data yang relevan di sini
        $pengembang = "Nama Pengembang"; // Ganti dengan nilai sesuai dengan kebutuhan Anda

        // Setelah variabel $pengembang ditetapkan, lewatkan nilainya ke tampilan
        return view('aside', compact('pengembang'));
    }
}
