<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lomba;

use Carbon\Carbon;

class LombaController extends Controller
{
    public function Lomba()
    {
        // Mengambil data dari model Dokung
        $data = Lomba::orderBy('nama_lomba', 'desc')->get();

        return view('lomba.listlomba', compact('data'));
    }
    public function LombaNew()
    {
        // Mengambil data dari model Dokung
        $data = Lomba::orderBy('nama_lomba', 'desc')->first();

        return view('lomba.modal.addlomba', compact('data'));
    }
    public function LombaStore(Request $request)
    {
        try {
            // Validasi data yang diterima dari request
            $request->validate([
                'nama_lomba' => 'required',
                'keterangan' => 'required',
                'jenis_lomba' => 'required',
                'status' => 'required',
                
            ]);
        
            // Membuat data baru
            $newData = new Lomba();
            $newData->nama_lomba = $request->nama_lomba;
            $newData->keterangan = $request->keterangan;
            $newData->jenis_lomba = $request->jenis_lomba;
            $newData->status = $request->status;
            $newData->save();

            // Tampilkan pesan sukses jika data berhasil disimpan
            return redirect()->route('listlomba')->with('success', 'Data berhasil dibuat');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function LombaEdit(string $id_lomba)
    {
        // Mengambil data dari model Dokung
        $data = Lomba::where('id_lomba', $id_lomba)->first();

        $dataL = Lomba::where('id_lomba', $id_lomba)->first();
        

        return view('lomba.modal.editlomba', compact('data', 'dataL'));
    }
    public function LombaUpdate(Request $request, $id_lomba)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'nama_lomba' => 'required',
                'keterangan' => 'required',
                'jenis_lomba' => 'required',
                'status' => 'required',
            ]);

            // Find the Dokung entry by its ID
            $lomba = Lomba::findOrFail($id_lomba);

            // Update the Dokung entry with the new data
            $lomba->nama_lomba = $request->nama_lomba;
            $lomba->keterangan = $request->keterangan;
            $lomba->jenis_lomba = $request->jenis_lomba;
            $lomba->status = $request->status;
            $lomba->save();

            // Redirect back with success message
            return redirect()->route('listlomba')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect back with error message if an exception occurs
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    public function LombaDelete(Request $request, $id_lomba)
    {
        try {
            $lomba = Lomba::find($id_lomba);

            if ($lomba) {
                // Delete the Dokung record
                $lomba->delete();

                return redirect()->route('listlomba')->with('success', 'Lomba record successfully deleted');
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}


