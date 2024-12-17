<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk mengimpor Auth
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Lomba;
use App\Models\LombaMahasiswa;
use SoapClient;


use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function ListMahasiswa()
    {
        $kode_pt_user = Auth::user()->kode_pt;

        $data = UserList::where('role', 'mahasiswa')
                        ->where('kode_pt', $kode_pt_user)
                        ->orderBy('id_userx', 'asc')
                        ->get();
    
        // Mengirimkan data ke view 'listmahasiswa'
        return view('mahasiswa.listmahasiswa', compact('data'));
    }
    public function LombaMahasiswa(string $id_userx)
    {
        $kode_pt_user = Auth::user()->kode_pt;

        $user = UserList::where('id_userx', $id_userx)
                        ->first();

        $data = LombaMahasiswa::with('lomba')
                        ->orderBy('tanggal_menang', 'asc')
                        ->get();
    
        // Mengirimkan data ke view 'listmahasiswa'
        return view('mahasiswa.lombamahasiswa', compact('data', 'user'));
    }

    public function PengajuanLombaM(string $id_userx)
    {
        $kode_pt_user = Auth::user()->kode_pt;
        

        $lm = UserList::where('id_userx', $id_userx)
            ->first();

        $lomba = Lomba::all();
    
        // Mengirimkan data ke view 'listmahasiswa'
        return view('mahasiswa.modal.pengajuanlombam', compact( 'lomba', 'lm'));
    }    
    public function StorePengajuanLombaM(Request $request)
{
    try {
        // Validasi data yang diterima dari request

        $request->validate([
            'keterangan' => 'nullable|string',
            'tanggal_menang' => 'required|date',
            'id_lomba' => 'required',
            'id_userx' => 'required',
            'status' => 'required',
        ]);

        // Ambil data dari request
        $voucher = $this->generateUniqueVoucher();
        $id_lomba = $request->input('id_lomba');
        $id_userx = $request->input('id_userx');
        $keterangan = $request->input('keterangan');
        $tanggal_menang = $request->input('tanggal_menang');
        $status = $request->input('status');

        // Membuat data baru
        $newData = new LombaMahasiswa();
        $newData->id_lomba = $id_lomba;
        $newData->id_userx = $id_userx;
        $newData->keterangan = $keterangan;
        $newData->tanggal_menang = $tanggal_menang;
        $newData->status = $status;
        $newData->voucher = $voucher; // Simpan voucher yang terenkripsi
        $newData->save();

        // Tampilkan pesan sukses jika data berhasil disimpan
        return redirect()->route('lombamahasiswa', ['id_userx' => $newData->id_userx])->with('success', 'Data berhasil dibuat');
    } catch (\Exception $e) {
        // Tampilkan pesan error jika terjadi kesalahan
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}
public function EditPengajuanLombaM(string $id_lomba_mahasiswa)
{
    // Mengambil data pengguna yang sedang login
    $kode_pt_user = Auth::user()->kode_pt;
    $id_userx = Auth::user()->id;  // Ambil id_userx dari pengguna yang sedang login

    // Ambil data dari model UserList berdasarkan id_userx
    $lm = UserList::where('id_userx', $id_userx)->first();

    // Ambil data lomba mahasiswa berdasarkan id_lomba_mahasiswa
    $data = LombaMahasiswa::with('user', 'lomba')
        ->where('id_lomba_mahasiswa', $id_lomba_mahasiswa)->first();

    $lomba = Lomba::all();

    return view('mahasiswa.modal.editpengajuanlombam', compact('lm', 'data', 'lomba'));
}

public function UpdatePengajuanLombaM(Request $request, $id_lomba_mahasiswa)
{
    try {
        // Validasi data yang diterima dari request
        $request->validate([
            'keterangan' => 'required',
            'tanggal_menang' => 'required|date',
            'id_lomba' => 'required',
            'status' => 'required',
        ]);

        // Temukan entri LombaMahasiswa berdasarkan id_lomba_mahasiswa
        $lomba = LombaMahasiswa::findOrFail($id_lomba_mahasiswa);

        // Ambil data dari request
        $id_lomba = $request->input('id_lomba');
        $keterangan = $request->input('keterangan');
        $tanggal_menang = $request->input('tanggal_menang');
        $status = $request->input('status');
        $id_userx = Auth::user()->id_userx; // Ambil id_userx dari pengguna yang sedang login

        // Perbarui entri LombaMahasiswa dengan data baru
        $lomba->id_lomba = $id_lomba;
        $lomba->id_userx = $id_userx;
        $lomba->keterangan = $keterangan;
        $lomba->tanggal_menang = $tanggal_menang;
        $lomba->status = $status;
        $lomba->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('lombamahasiswa', ['id_userx' => $id_userx])->with('success', 'Data berhasil diperbarui');
    } catch (\Exception $e) {
        // Redirect kembali dengan pesan error jika terjadi kesalahan
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
}
    public function DeletePengajuanLombaM(Request $request, $id_lomba_mahasiswa)
    {
        try {
            $lombam = LombaMahasiswa::find($id_lomba_mahasiswa);

            if ($lombam) {
                // Delete the Dokung record
                $lombam->delete();

                return redirect()->route('lombamahasiswa', ['id_userx' => $lombam->id_userx])->with('success', 'Data berhasil diperbarui');
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    private function generateUniqueVoucher()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
    $voucher = '';

    // Generate voucher 8 karakter
    for ($i = 0; $i < 8; $i++) {
        $voucher .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    // Pastikan voucher unik di database
    while (LombaMahasiswa::where('voucher', $voucher)->exists()) {
        $voucher = '';
        for ($i = 0; $i < 8; $i++) {
            $voucher .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
    }

    return $voucher; // Kembalikan voucher yang dihasilkan
}
    public function getCategoryFromSoap()
    {
        try {
            // URL dari WSDL
            $wsdl = 'http://localhost/api/futsal?wsdl'; // Ganti dengan URL WSDL yang sesuai

            // Membuat instansi SOAP client
            $client = new SoapClient($wsdl);

            // Memanggil fungsi getCategory dari WSDL
            $result = $client->__soapCall('getCategory', []);

            // Jika berhasil, hasilnya akan ada dalam variabel $result
            return response()->json($result);
        } catch (\Exception $e) {
            // Menangani error
            return response()->json(['error' => 'Failed to connect to SOAP service: ' . $e->getMessage()], 500);
        }
    }



}


