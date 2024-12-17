<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VPemimpinPT;
use App\Models\Jabatan;
use App\Models\PT;
use App\Models\PemimpinPT;



use Carbon\Carbon;



class DaftarPemimpinController extends Controller
{
    public function DaftarPemimpin()
    {
        try {
            // Mengambil data dari model VPemimpinPT
            $data = VPemimpinPT::whereIn('status_pts', ['A', 'N'])
                ->orderBy('kd_pts', 'asc')
                ->get();

            // Lakukan perubahan pada $data jika diperlukan

            return view('DP.daftarpemimpin', compact('data'));
        } catch (\Exception $e) {
            // Tambahkan penanganan kesalahan sesuai kebutuhan Anda
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function DaftarPejabat(string $id_pts)
    {
        try {
            // Mengambil data PT berdasarkan id_pts menggunakan model VPemimpinPT
            $dataPT = PT::where('id_pts', $id_pts)->first();

            // Mengambil data pemimpin PT berdasarkan id_pts menggunakan model VPemimpinPT
            $data = PemimpinPT::with('jabatan')
            ->where('id_pts', $dataPT->id_pts)
                ->get();

            foreach ($data as $item) {
                // Format tanggal awal dan akhir
                $item->formatted_tgl_awal = $this->form_tgl($item->tgl_awal);
                $item->formatted_tgl_akhir = $this->form_tgl($item->tgl_akhir);
            }

            return view('DP.daftarpejabat', compact('data', 'dataPT'));
        } catch (\Exception $e) {
            // Tambahkan penanganan kesalahan sesuai kebutuhan Anda
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function NewDaftarPejabat(string $id_pts)
    {
        
        $dataPJ = PT::where('id_pts', $id_pts)->first();

        $data = PemimpinPT::where('id_pts', $dataPJ->id_pts)->first();

        $allProgram = Jabatan::all();

        return view('DP.modalDPejabat.NewPejabat', compact('data', 'dataPJ', 'allProgram'));
    }


    public function StoreDaftarPejabat(Request $request, string $id_pts)
{
    try {
        
        // Validasi data yang diterima dari request
        $request->validate([
            'nama_pimpinan' => 'required',
            'nm_jabatan_pim' => 'required',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'no_hp' => 'required',
            'link_dokumen' => 'required',
            'status_jab' => 'required',
        ]);

        $id_jabatan_pim = Jabatan::where('nm_jabatan_pim', $request->nm_jabatan_pim)->value('id_jabatan');

        // Membuat data baru
        $newData = PemimpinPT::create([
            'id_pts' => $id_pts,
            'id_pimpinan' => $this->generateUniqueIDpimpinan(), // Menggunakan fungsi generateUniqueIDpimpinan() untuk menghasilkan ID unik
            'id_jabatan_pim' => $id_jabatan_pim,
            'nama_pimpinan' => $request->nama_pimpinan,
            'nm_jabatan_pim' => $request->nm_jabatan_pim,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'no_hp' => $request->no_hp,
            'link_dokumen' => $request->link_dokumen,
            'status_jab' => $request->status_jab
        ]);

        // Tampilkan pesan sukses jika data berhasil disimpan
        return redirect()->route('daftarpejabat', ['id_pts' => $id_pts])->with('success', 'Data berhasil dibuat');
    } catch (\Exception $e) {
        // Tampilkan pesan error jika terjadi kesalahan
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}


    


    public function EditDaftarPejabat(string $id_pimpinan)
    {

        $data = PemimpinPT::with('jabatan')
        ->where('id_pimpinan', $id_pimpinan)->first();

        $dataPJ = PT::where('id_pts', $data->id_pts)->first();

        $allProgram = Jabatan::all();

        return view('DP.modalDPejabat.EditPejabat', compact('data', 'dataPJ', 'allProgram'));
    }

    public function UpdateDaftarPejabat(Request $request, $id_pimpinan)
{
    try {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama_pimpinan' => 'required',
            'id_jabatan_pim' => 'required',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'no_hp' => 'required',
            'link_dokumen' => 'required',
            'status_jab' => 'required',
        ]);

        // Cari data pejabat berdasarkan id_pts dan id_pimpinan
        $pejabat = PemimpinPT::findOrFail($id_pimpinan);

        // Update data pejabat
        $pejabat->update([
            'nama_pimpinan' => $request->nama_pimpinan,
            'id_jabatan_pim' => $request->id_jabatan_pim,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
            'no_hp' => $request->no_hp,
            'link_dokumen' => $request->link_dokumen,
            'status_jab' => $request->status_jab
        ]);

        // Tampilkan pesan sukses jika data berhasil disimpan
        return redirect()->route('daftarpejabat', ['id_pts' => $pejabat->id_pts])->with('success', 'Data berhasil diperbarui');
    } catch (\Exception $e) {
        // Tampilkan pesan error jika terjadi kesalahan
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
}
public function DeleteDaftarPejabat(Request $request, $id_pimpinan)
    {
        try {
            $deletePem = PemimpinPT::find($id_pimpinan);

            if ($deletePem) {
                // Delete the Dokung record
                $deletePem->delete();

                return redirect()->route('daftarpejabat', ['id_pts' => $deletePem->id_pts])->with('success', 'Pejabat record successfully deleted');
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    private function cek_apt($todays_date, $start_date, $end_date)
	{
		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
		$todays_date = strtotime($todays_date);

		if ($todays_date >= $start_date && $todays_date <= $end_date) {
			return "success"; // Ubah dari "success" menjadi konsisten menggunakan kelas Bootstrap
		} else if ($todays_date < $end_date) {
			return "warning"; // Ubah dari "danger" menjadi "warning" sesuai kondisi belum berlaku
		} else {
			return "danger"; // Tetapkan sebagai "danger" untuk kondisi lewat masa berlaku
		}
	}

    private function form_tgl($waktu)
    {
        // Tanggal, 1-31 dst, tanpa leading zero.
        $tanggal = date('j', strtotime($waktu));

        // Bulan, Januari, Maret dst
        $bulan_array = array(
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agust',
            9 => 'Sept',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];

        // Tahun
        $tahun = date('Y', strtotime($waktu));

        // Senin, 12 Oktober 2014
        return "$tanggal $bulan $tahun";
    }

    private function generateUniqueIDpimpinan()
    {
        do {
            $uniqueID = mt_rand(100000000000, 999999999999);
        } while (PemimpinPT::where('id_pimpinan', $uniqueID)->exists());

        return $uniqueID;
    }
    
}