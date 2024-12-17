<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dokung;

use Carbon\Carbon;

class DokumenPendukung extends Controller
{
    public function Dokung()
    {
        // Mengambil data dari model Dokung
        $data = Dokung::orderBy('tgl_dibuat', 'desc')->get();

        return view('dokumen.listdokung', compact('data'));
    }
    public function DokungNew()
    {
        // Mengambil data dari model Dokung
        $data = Dokung::orderBy('tgl_dibuat', 'desc')->first();

        return view('dokumen.modal.adddokumen', compact('data'));
    }
    public function DokungStore(Request $request)
    {
        try {
            // Validasi data yang diterima dari request
            $request->validate([
                'jenis_dok' => 'required',
                'nama_dok' => 'required',
                'digunakan' => 'required',
                'status' => 'required',
                
            ]);
        
            // Membuat data baru
            $newData = new Dokung();
            $newData->jenis_dok = $request->jenis_dok;
            $newData->nama_dok = $request->nama_dok;
            $newData->digunakan = $request->digunakan;
            $newData->status = $request->status;
            $newData->save();

            // Tampilkan pesan sukses jika data berhasil disimpan
            return redirect()->route('listdokung')->with('success', 'Data berhasil dibuat');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function DokungEdit(string $id_dok)
    {
        // Mengambil data dari model Dokung
        $data = Dokung::orderBy('tgl_dibuat', 'desc')->first();

        $dataD = Dokung::where('id_dok', $id_dok)->first();
        

        return view('dokumen.modal.editdokumen', compact('data', 'dataD'));
    }
    public function DokungUpdate(Request $request, $id_dok)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'jenis_dok' => 'required',
                'nama_dok' => 'required',
                'digunakan' => 'required',
                'status' => 'required',
            ]);

            // Find the Dokung entry by its ID
            $dokung = Dokung::findOrFail($id_dok);

            // Update the Dokung entry with the new data
            $dokung->jenis_dok = $request->jenis_dok;
            $dokung->nama_dok = $request->nama_dok;
            $dokung->digunakan = $request->digunakan;
            $dokung->status = $request->status;
            $dokung->save();

            // Redirect back with success message
            return redirect()->route('listdokung')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect back with error message if an exception occurs
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    public function DokungDelete(Request $request, $id_dok)
    {
        try {
            $dokung = Dokung::find($id_dok);

            if ($dokung) {
                // Delete the Dokung record
                $dokung->delete();

                return redirect()->route('listdokung')->with('success', 'Dokung record successfully deleted');
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}


