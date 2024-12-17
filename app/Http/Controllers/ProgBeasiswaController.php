<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Beasiswa;
use App\Models\Dokung;
use App\Models\DokumenB;
use App\Models\Komponen;

use Carbon\Carbon;

class ProgBeasiswaController extends Controller
{
    public function ProgramBeasiswa()
    {
        // Mengambil data dari model Dokung
        $data = Beasiswa::orderBy('id_beasiswa', 'desc')->get();

        return view('beasiswa.programbeasiswa', compact('data'));
    }
    public function ProgramBeasiswaNew()
    {
        // Mengambil data dari model Dokung
        $data = Beasiswa::orderBy('id_beasiswa', 'desc')->first();

        return view('beasiswa.modal.addbeasiswa', compact('data'));
    }
    public function ProgramBeasiswaStore(Request $request)
    {
        try {
            // Validasi data yang diterima dari request
            $request->validate([
                'jenis_beasiswa' => 'required',
                'keterangan' => 'required',
                'pt_penerima' => 'required',
                'status' => 'required',
                
            ]);
        
            // Membuat data baru
            $newData = new Beasiswa();
            $newData->jenis_beasiswa = $request->jenis_beasiswa;
            $newData->keterangan = $request->keterangan;
            $newData->pt_penerima = $request->pt_penerima;
            $newData->status = $request->status;
            $newData->save();

            // Tampilkan pesan sukses jika data berhasil disimpan
            return redirect()->route('programbeasiswa')->with('success', 'Data berhasil dibuat');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function ProgramBeasiswaEdit(string $id_beasiswa)
    {
        // Mengambil data dari model Dokung
        $data2 = Beasiswa::orderBy('id_beasiswa', 'desc')->get();

        $data = Beasiswa::where('id_beasiswa', $id_beasiswa)->first();

        $dok = DokumenB::with('dokung', 'beasiswa')->where('id_beasiswa', $data->id_beasiswa)->first();

        $doklist = DokumenB::with('dokung')->where('id_beasiswa', $id_beasiswa)->get();

        $allDokung = Dokung::all();
        
        return view('beasiswa.editbeasiswa', compact('data' , 'dok', 'allDokung', 'doklist'));
    }
    public function ProgramBeasiswaUpdate(Request $request, $id_beasiswa)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'jenis_beasiswa' => 'required',
                'keterangan' => 'required',
                'pt_penerima' => 'required',
                'status' => 'required',
            ]);

            // Find the Beasiswa entry by its ID
            $beasiswa = Beasiswa::findOrFail($id_beasiswa);

            // Update the Beasiswa entry with the new data
            $beasiswa->jenis_beasiswa = $request->jenis_beasiswa;
            $beasiswa->keterangan = $request->keterangan;
            $beasiswa->pt_penerima = $request->pt_penerima;
            $beasiswa->status = $request->status;
            $beasiswa->save();

            // Redirect back with success message
            return redirect()->route('editbeasiswa', ['id_beasiswa' => $beasiswa->id_pts])->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect back with error message if an exception occurs
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    public function ProgramBeasiswaDelete(Request $request, $id_beasiswa)
    {
        try {
			// Hapus data PengurusYYS terkait dengan ID AktaYYS
			$dokumenB = Beasiswa::where('id_beasiswa', $id_beasiswa)->first();
			if ($dokumenB) {
				DokumenB::where('id_beasiswa', $dokumenB->id_beasiswa)->delete();
				$dokumenB->delete();
			}
			if ($dokumenB) {
				Komponen::where('id_beasiswa', $dokumenB->id_beasiswa)->delete();
				$dokumenB->delete();
			}
			// Hapus data dari tbl_yayasan_pt
			$beasiswa = Beasiswa::findOrFail($id_beasiswa);
			if ($beasiswa->delete()) {
				return redirect()->route('programbeasiswa')->with([
					'message' => 'Data berhasil dihapus',
					'alert-type' => 'success'
				]);
			} else {
				return redirect()->route('programbeasiswa')->with([
					'message' => 'Terdapat kendala saat menghapus, coba ulangi lagi!',
					'alert-type' => 'error'
				]);
			}
		} catch (\Exception $e) {
			return redirect()->route('programbeasiswa')->with([
				'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
				'alert-type' => 'error'
			]);
		}
    }


    public function StorePengajuanKuota(Request $request)
    {
        $id_cat = $request->input('id_cat');
        $id_beasiswa  = $request->input('id_beasiswa');
        $urutan = $request->input('urutan');
        $status = $request->input('status');

        // Buat instance baru dari DokumenB
        $storeD = new DokumenB();

        // Isi properti-properti DokumenB dengan nilai yang diberikan
        $storeD->id_cat = $id_cat;
        $storeD->id_beasiswa = $id_beasiswa;
        $storeD->urutan = $urutan;
        $storeD->status = $status;

        // Simpan objek DokumenB ke dalam basis data
        $storeD->save();

        return redirect()->back()->with('success', 'Data telah berhasil disimpan.');
    }

    public function DeletePengajuanKuota(Request $request, $id)
    {
        try {
            $dokumenb = DokumenB::find($id);

            if ($dokumenb) {
                // Delete the Dokung record
                $dokumenb->delete();

                return redirect()->back()->with('success', 'Data telah berhasil diperbarui.');
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function komponenbeasiswa(string $id_beasiswa)
    {
        // Mengambil data dari model Dokung
        $dataB = Beasiswa::with('komponen')->where('id_beasiswa', $id_beasiswa)->first();

        $data = Komponen::where('id_beasiswa', $dataB->id_beasiswa)->first();


        $dataTable = Komponen::where('id_beasiswa', $dataB->id_beasiswa)->get();
        
        return view('beasiswa.komponenbeasiswa', compact('dataB', 'data', 'dataTable'   ));
    }

    public function komponenbeasiswaStore(Request $request)
{
    $request->validate([
        'id_beasiswa' => 'required',
        'nm_komponen' => 'required',
        'pagu_awal' => 'required|int', // Menambahkan aturan validasi untuk memastikan nilai adalah integer
    ]);

    $id_beasiswa = $request->input('id_beasiswa');
    $status = $request->input('status');
    $nm_komponen = $request->input('nm_komponen');
    $pagu_awal = $request->input('pagu_awal');
    
    $request->validate([
        'id_beasiswa' => 'required',
        'nm_komponen' => 'required',
        'pagu_awal' => 'required',
       ]);

    // Ambil file yang diunggah

    $storeK = new Komponen();

    // Isi properti-properti Komponen dengan nilai yang diberikan
    $storeK->status = $status;
    $storeK->id_beasiswa = $id_beasiswa; // Gunakan ID Beasiswa dari input
    $storeK->nm_komponen = $nm_komponen;
    $storeK->pagu_awal = $pagu_awal;

    // Simpan objek Komponen ke dalam basis data
    $storeK->save();

    return redirect()->back()->with('success', 'Data telah berhasil disimpan.');
}
    public function komponenbeasiswaEdit(string $id)
        {            

            $data = Komponen::where('id', $id)->first();


            return view('beasiswa.modal.editkomponen', compact('data'));
        }
    public function komponenbeasiswaUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'nm_komponen' => 'required',
            'pagu_awal' => 'required',
            'status' => 'required',
        ]);

        // Find the Komponen entry by its ID
        $komponen = Komponen::findOrFail($id);

        // Update the Komponen entry with the new data
        $komponen->nm_komponen = $request->input('nm_komponen');
        $komponen->pagu_awal = $request->input('pagu_awal');
        $komponen->status = $request->input('status');

        // Save the updated entry
        $komponen->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data telah berhasil diperbarui.');
    }
    public function komponenbeasiswaDelete(Request $request, $id)
    {
        try {
            $komponen = Komponen::find($id);

            if ($komponen) {
                // Delete the Dokung record
                $komponen->delete();

                return redirect()->back()->with('success', 'Data telah berhasil diperbarui.');
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


}


