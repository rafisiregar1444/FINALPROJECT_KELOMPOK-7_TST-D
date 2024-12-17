<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserList; // Import model UserList

class PemesananTiketController extends Controller
{
    public function showForm()
    {
        // Ambil daftar mahasiswa dari tabel user_lists menggunakan model UserList
        $mahasiswa = UserList::where('role', 'mahasiswa')->get(['id_userx as id', 'nama_pt as name']); // Menggunakan alias untuk id dan name sesuai dengan kebutuhan Anda

        return view('form-pemesanan', compact('mahasiswa'));
    }

    // Method lain untuk pemesanan tiket bisa ditambahkan di sini
}
