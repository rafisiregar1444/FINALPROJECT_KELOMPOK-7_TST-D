<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserList;

class MyTicketController extends Controller
{
    public function iisma()
    {
        $mahasiswa = UserList::where('role', 'mahasiswa')->get(['id_userx', 'nama_pt']);
        
        return view('mahasiswa.iisma', compact('mahasiswa'));
        
    }
    public function inspiba()
    {
        $mahasiswa = UserList::where('role', 'mahasiswa')->get(['id_userx', 'nama_pt']);
        return view('mahasiswa.inspiba', compact('mahasiswa'));
    }

    public function iismaFunc(Request $request)
    {
        $mahasiswa = UserList::where('role', 'mahasiswa')->get(['id_userx', 'nama_pt']);
        
        $transportasiId = $request->input('transportasiId');
        $mahasiswaIds = $request->input('jumlahOrang'); // Array id mahasiswa yang dipilih

        if (!$transportasiId || empty($mahasiswaIds)) {
            return back()->withErrors(['error' => 'Transportasi dan mahasiswa harus dipilih'])->with(compact('mahasiswa'));
        }

        $jumlahOrang = count($mahasiswaIds);

        $routeData = $this->getRouteData($transportasiId);

        if (isset($routeData->error)) {
            return back()->withErrors(['error' => $routeData->error])->with(compact('mahasiswa'));
        }

        $hargaPerOrang = $routeData->harga;

        $totalHarga = $hargaPerOrang * $jumlahOrang;

        $disc = 10;
        $diskon = 0.1 * $totalHarga; 
        $hargaSetelahDiskon = $totalHarga - $diskon;

        return view('mahasiswa.iisma', compact('mahasiswa', 'routeData', 'jumlahOrang', 'hargaPerOrang', 'totalHarga', 'diskon', 'disc', 'hargaSetelahDiskon'));
    }
    
    public function inspibaFunc(Request $request)
    {
        $mahasiswa = UserList::where('role', 'mahasiswa')->get(['id_userx', 'nama_pt']);
        
        $transportasiId = $request->input('transportasiId');
        $mahasiswaIds = $request->input('jumlahOrang'); 

        if (!$transportasiId || empty($mahasiswaIds)) {
            return back()->withErrors(['error' => 'Transportasi dan mahasiswa harus dipilih'])->with(compact('mahasiswa'));
        }

        $jumlahOrang = count($mahasiswaIds);

        $routeData = $this->getRouteData($transportasiId);

        if (isset($routeData->error)) {
            return back()->withErrors(['error' => $routeData->error])->with(compact('mahasiswa'));
        }

        $hargaPerOrang = $routeData->harga;

        $totalHarga = $hargaPerOrang * $jumlahOrang;
        $disc = ($jumlahOrang/100) *100;
        $diskon = ($jumlahOrang/100) * $totalHarga;
        $hargaSetelahDiskon = $totalHarga - $diskon;

        return view('mahasiswa.inspiba', compact('mahasiswa', 'routeData', 'jumlahOrang', 'hargaPerOrang', 'totalHarga', 'diskon', 'disc','hargaSetelahDiskon'));
    }

    private function getRouteData($transportasiId)
    {
        $route = DB::connection('futsal2')->table('rute')
            ->join('transportasi', 'rute.transportasi_id', '=', 'transportasi.id')
            ->where('transportasi.id', $transportasiId)
            ->select('rute.harga', 'rute.id AS rute_id', 'transportasi.name AS transportasi_name')
            ->first();

        if (!$route) {
            $error = new \stdClass();
            $error->error = 'Transportasi tidak ditemukan.';
            return $error;
        }

        return $route; 
    }
    
}
