<?php

namespace App\Http\Controllers;

use App\Models\VAkreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Models\PT;
use App\Models\KotaPT;
use App\Models\ProdiPT;
use App\Models\JenjangPendidikan;
use Carbon\Carbon;
use App\Models\YayasanPT;
use App\Models\AkreditasiPT;
use App\Models\AkreditasiPS;
use App\Models\lembagaakreditasi;
use App\Models\PeringkatAkreditasi;
use App\Models\lembagaakreditasiprodi;




class PTController extends Controller
{
	public function listPTS(){
		$data = DB::table('tbl_perguruan_tinggi')
			->whereIn('status_pts', ['A', 'N'])
			->leftJoin('tbl_akreditasi_pt', 'tbl_perguruan_tinggi.id_pts', '=', 'tbl_akreditasi_pt.id_pts')
			->leftJoin('ref_peringkat_akreditasi', 'tbl_akreditasi_pt.peringkat_apt', '=', 'ref_peringkat_akreditasi.id_peringkat')
			->leftJoin('ref_kota', 'tbl_perguruan_tinggi.nm_kota', '=', 'ref_kota.id_kota')
			->select('tbl_perguruan_tinggi.*', 'tbl_akreditasi_pt.*', 'ref_peringkat_akreditasi.*', 'ref_kota.nama_kota')
			->orderBy('tbl_perguruan_tinggi.kd_pts', 'ASC')
			->get();
	
		$DATE_NOW = Carbon::now()->format('Y-m-d H:m:s');
	
		// Call the data processing function
		$data = $this->processDataRekapList($data, $DATE_NOW);

		return view('pt.listPTS', compact('data'));
	}   

	public function listPTSAktif(){
		$data = DB::table('tbl_perguruan_tinggi')
			->whereIn('status_pts', ['A', 'N'])
			->Join('tbl_akreditasi_pt', 'tbl_perguruan_tinggi.id_pts', '=', 'tbl_akreditasi_pt.id_pts')
			->Join('ref_peringkat_akreditasi', 'tbl_akreditasi_pt.peringkat_apt', '=', 'ref_peringkat_akreditasi.id_peringkat')
			->Join('ref_kota', 'tbl_perguruan_tinggi.nm_kota', '=', 'ref_kota.id_kota')
			->select('tbl_perguruan_tinggi.*', 'tbl_akreditasi_pt.*', 'ref_peringkat_akreditasi.*', 'ref_kota.nama_kota')
			->orderBy('tbl_perguruan_tinggi.kd_pts', 'ASC')
			->get();
	
		$DATE_NOW = Carbon::now()->format('Y-m-d H:m:s');
	
		// Panggil fungsi untuk pengolahan data
		$data = $this->processDataRekapAktif($data, $DATE_NOW);
	
		return view('pt.listPTSAktif')->with('data', $data);
	}

	public function listPTSBermasalah(){
		$data = DB::table('tbl_perguruan_tinggi')
			->whereIn('status_pts', ['N'])
			->orWhere('status_khusus', ['N'])
			->leftJoin('tbl_akreditasi_pt', 'tbl_perguruan_tinggi.id_pts', '=', 'tbl_akreditasi_pt.id_pts')
			->leftJoin('ref_peringkat_akreditasi', 'tbl_akreditasi_pt.peringkat_apt', '=', 'ref_peringkat_akreditasi.id_peringkat')
			->leftJoin('ref_kota', 'tbl_perguruan_tinggi.nm_kota', '=', 'ref_kota.id_kota')
			->select('tbl_perguruan_tinggi.*', 'tbl_akreditasi_pt.*', 'ref_peringkat_akreditasi.*', 'ref_kota.nama_kota')
			->orderBy('tbl_perguruan_tinggi.kd_pts', 'ASC')
			->get();
	
		$DATE_NOW = Carbon::now()->format('Y-m-d H:m:s');
			
		// Panggil fungsi untuk pengolahan data
		$data = $this->processDataBermasalahTutup($data, $DATE_NOW);
		
		return view('pt.listPTSBermasalah')->with('data', $data);
	}

	public function listPTSTutup(){
		$data = DB::table('tbl_perguruan_tinggi')
			->whereNotIn('status_pts', ['A', 'N'])
			->leftJoin('tbl_akreditasi_pt', 'tbl_perguruan_tinggi.id_pts', '=', 'tbl_akreditasi_pt.id_pts')
			->leftJoin('ref_peringkat_akreditasi', 'tbl_akreditasi_pt.peringkat_apt', '=', 'ref_peringkat_akreditasi.id_peringkat')
			->leftJoin('ref_kota', 'tbl_perguruan_tinggi.nm_kota', '=', 'ref_kota.id_kota')
			->select('tbl_perguruan_tinggi.*', 'tbl_akreditasi_pt.*', 'ref_peringkat_akreditasi.*', 'ref_kota.nama_kota')
			->orderBy('tbl_perguruan_tinggi.kd_pts', 'ASC')
			->get();
	
		$DATE_NOW = Carbon::now()->format('Y-m-d H:m:s');
	
		// Panggil fungsi untuk pengolahan data
		$data = $this->processDataBermasalahTutup($data, $DATE_NOW);
	
		return view('pt.listPTSTutup')->with('data', $data);
	}
	public function AjukanAkreditasi(){
		$data = DB::table('v_pt_akreditasi')
			->get();

		return view('pt.ajukanakreditasi')->with('data', $data);
	}

	public function AjukanAkreditasiPost(Request $request, string $id_pts)
	{
		try {
			
			// Validasi input
			$idpts = $request->input('id_pts');
	
			$id_akreditasi = $this->generateUniqueIDakreditasiPT();

			$newAkreditasi = AkreditasiPT::create([
				'id_pts' => $idpts,
				'id_akreditasi' => $id_akreditasi,
			]);	

			if ($newAkreditasi) {
				return redirect()->route('ajukanakreditasi', ['id_pts' => $newAkreditasi->id_pts])->with('success', 'Data berhasil dibuat');
			} else {
				return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
			}
		} catch (\Exception $e) {
			return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
		}
	}
	
	public function add()
	{
		$data = PT::with('kota')
				->get();

		// Mengambil nama_kota yang sesuai dengan nm_kota pada model PT

		$allKota = KotaPT::all();

		return view('pt.modalPT.addpts', compact('data', 'allKota'));
	}
	

	public function edit(string $id_pts)
	{
		$data = PT::with('kota')
				->where('id_pts', $id_pts)
				->first();

		// Mengambil nama_kota yang sesuai dengan nm_kota pada model PT
		$kota = KotaPT::where('id_kota', $data->nm_kota)->get();

		$allKota = KotaPT::all();

		return view('pt.editpts', compact('data', 'kota', 'allKota'));
	}
	public function store(Request $request)
{
    try {
		
        // Validasi input
        $validatedData = $request->validate([
            'kd_pts' => 'required|max:6',
            'pass_key' => 'required|max:8',
            'nama_pts' => 'required|max:200',
            'alamat' => 'required|max:200',
            'no_telp' => 'required|max:80',
            'email' => 'required|max:50',
            'laman' => 'required|max:50',
            'status_pts' => 'required|in:A,N,H,B,M,K',
            'nm_kota' => 'required|numeric|between:1,35',
			'ultah' => 'required|date',
            // Tambahkan aturan validasi lain jika diperlukan
        ]);

        // Buat ID unik PT
        $id_pts = $this->generateUniqueIDpt();

        // Buat data PT baru
        $newData = PT::create([
            'id_pts' => $id_pts,
            'kd_pts' => $validatedData['kd_pts'],
            'pass_key' => $validatedData['pass_key'],
            'nama_pts' => $validatedData['nama_pts'],
            'alamat' => $validatedData['alamat'],
            'no_telp' => $validatedData['no_telp'],
            'email' => $validatedData['email'],
            'laman' => $validatedData['laman'],
            'status_pts' => $validatedData['status_pts'],
            'nm_kota' => $validatedData['nm_kota'],
			'ultah' => $validatedData['ultah'],
            // Tambahkan atribut lain jika diperlukan
        ]);

		$id_akreditasi = $this->generateUniqueIDakreditasiPT();

	// Buat data AkreditasiPT baru
		$newAkreditasi = AkreditasiPT::create([
			'id_pts' => $id_pts,
			'id_akreditasi' => $id_akreditasi,
			// masukkan atribut lain jika diperlukan
		]);

		$id_prodi_pts = $this->generateUniqueIDprodiPTS();
		
		$newProdi = ProdiPT::create([
			'id_pts' => $id_pts,
			'id_prodi_pts' => $id_prodi_pts,
			// masukkan atribut lain jika diperlukan
		]);

        // Periksa apakah data berhasil disimpan
        if ($newData && $newAkreditasi && $newProdi) {
            return redirect()->route('listpts')->with('success', 'Data berhasil dibuat');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
        }
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}



	public function update(Request $request, $id_pts)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'kd_pts' => 'required|max:6',
				'nama_pts' => 'required|max:200',
				'alamat' => 'required|max:200',
				'no_telp' => 'required|max:80',
				'email' => 'required|max:50',
				'laman' => 'required|max:50',
				'nm_kota' => 'required|numeric|between:1,35',
				'ultah' => 'required|date',
                // Aturan validasi lainnya jika diperlukan
            ]);

            // Ambil data yang akan diupdate
            $data = PT::findOrFail($id_pts);

            // Update data berdasarkan input yang valid
            $data->update([
                'kd_pts' => $request->kd_pts,
                'nama_pts' => $request->nama_pts,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'laman' => $request->laman,
                'nm_kota' => $request->nm_kota,
				'ultah' => $request->ultah,
                // Atribut lainnya yang diperlukan
            ]);	

            // Berhasil update, kembalikan respons berhasil
            return redirect('listpts')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

	public function perubahanstatus(string $id_pts)
	{
		$data = PT::where('id_pts', $id_pts)
				->first();

		// Mengambil nama_kota yang sesuai dengan nm_kota pada model PT

		return view('pt.modalPT.PerubahanStatus', compact('data'));
	}

	public function updatePerubahanStatus(Request $request, $id_pts)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
				'status_pts' => 'required|in:A,N,H,B,M,K',
                // Aturan validasi lainnya jika diperlukan
            ]);

            // Ambil data yang akan diupdate
            $data = PT::findOrFail($id_pts);

            // Update data berdasarkan input yang valid
            $data->update([
                'status_pts' => $request->status_pts,
                // Atribut lainnya yang diperlukan
            ]);

            // Berhasil update, kembalikan respons berhasil
            return redirect()->route('editpts', ['id_pts' => $id_pts])->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }
	
	public function ProdiPT(string $id_pts)
	{
		$pt = PT::where('id_pts', $id_pts)->first();

		$data = ProdiPT::with('jenjang')
			->leftJoin('ref_jenjang_pendidikan', 'tbl_prodi_pt.program', '=', 'ref_jenjang_pendidikan.kode_jenjang')
			->where('tbl_prodi_pt.id_pts', $id_pts)
			->orderBy('tbl_prodi_pt.program', 'DESC')
			->orderBy('tbl_prodi_pt.status_prodi', 'ASC')
			->get();

		return view('pt.prodipts', compact('data', 'pt'));
	}


	public function ProdiPTnew(string $id_pts)
	{
		$pt = PT::where('id_pts', $id_pts)->first();

		$data = ProdiPT::with('jenjang')
		->where('id_pts', $id_pts)
        ->first();

		$allProgram = JenjangPendidikan::all();

		return view('pt.modalProdiPT.NewProdi', compact('data', 'pt', 'allProgram'));
	}
	
	public function ProdiPTstore(Request $request, string $id_pts)
	{

		$validatedData = $request->validate([
			'kode_prodi' => 'required|max:6',
			'nama_prodi' => 'required|max:150',
			'program' => 'required|max:2',
			'status_prodi' => 'required|max:2',
			'no_sk' => 'required|max:20',
			'tgl_sk' => 'required|date',
			// Aturan validasi lainnya jika diperlukan
		]);
		
		try {
			$id_pts = $request->id_pts ?? null;

				// Jika $id_yys_pt bernilai null, kembalikan pesan error
				if ($id_pts === null) {
					return redirect()->back()->withInput()->with('error', 'ID yayasan tidak valid');
				}
					

			$id_prodi_pts = $this->generateUniqueIDprodiPTS();

			$newData = ProdiPT::create([
				'id_prodi_pts' => $id_prodi_pts,
				'id_pts' => $id_pts,
				'kode_prodi' => $request->kode_prodi,
				'nama_prodi' => $request->nama_prodi,
				'program' => $request->program,
				'status_prodi' => $request->status_prodi,
				'no_sk' => $request->no_sk,
				'tgl_sk' => $request->tgl_sk,
				// Atribut lainnya yang diperlukan
			]);

		if ($newData) {
			return redirect()->route('prodipt', ['id_pts' => $newData->id_pts])->with('success', 'Data berhasil dibuat');	
		} else {
			return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
		}
	} catch (\Exception $e) {
		return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());	
		}		

	}



	public function ProdiPTedit(string $id_prodi_pts)
	{
		$data = ProdiPT::with('jenjang')->where('id_prodi_pts', $id_prodi_pts)->first();
		$pt = PT::where('id_pts', $data->id_pts)->first();

		// Assuming `$data->progrma` contains the value you want to filter
		$allProgram = JenjangPendidikan::all();

		return view('pt.modalProdiPT.EditProdi', compact('data', 'pt', 'allProgram'));
	}

	public function ProdiPTupdate(Request $request, $id_prodi_pts)
	{
		try {
			// Validasi data
			$validatedData = $request->validate([
				'kode_prodi' => 'required|max:6',
				'nama_prodi' => 'required|max:150',
				'program' => 'required|max:2',
				'status_prodi' => 'required|max:2',
				'no_sk' => 'required|max:20',
				'tgl_sk' => 'required|date',
				// Aturan validasi lainnya jika diperlukan
			]);

			// Ambil data yang akan diupdate
			$data = ProdiPT::findOrFail($id_prodi_pts);

			if (!$data) {
				return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
			}

			// Update data menggunakan array asosiatif dari input yang valid
			$data->kode_prodi = $request->kode_prodi;
			$data->nama_prodi = $request->nama_prodi;
			$data->program = $request->program;
			$data->status_prodi = $request->status_prodi;
			$data->no_sk = $request->no_sk;
			$data->tgl_sk = $request->tgl_sk;
			// Atribut lainnya yang diperlukan
			$data->save();

			// Berhasil update, kembalikan respons berhasil
			return redirect()->route('prodipt', ['id_pts' => $data->id_pts])->with('success', 'Data berhasil diupdate');
		} catch (\Exception $e) {
			// Tangani kesalahan jika terjadi
			return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
		}
	}
	
	public function DeleteProdi($id_prodi_pts) {
		try {
			// Hapus data AkreditasiPS terkait dengan ID ProdiPT
			$prodi = ProdiPT::where('id_prodi_pts', $id_prodi_pts)->first();
			if ($prodi) {
				AkreditasiPS::where('id_prodi_pts', $prodi->id_prodi_pts)->delete();
			}
			
			// Hapus data dari tabel ProdiPT
			$prodi = ProdiPT::findOrFail($id_prodi_pts);
			if ($prodi->delete()) {
				return redirect()->route('prodipt', ['id_pts' => $prodi->id_pts])->with([
					'message' => 'Data berhasil dihapus',
					'alert-type' => 'success'
				]);
			} else {
				return redirect()->route('prodipt', ['id_pts' => $prodi->id_pts])->with([
					'message' => 'Terdapat kendala saat menghapus, coba ulangi lagi!',
					'alert-type' => 'error'
				]);
			}
		} catch (\Exception $e) {
			return redirect()->route('prodipt', ['id_pts' => $prodi->id_pts])->with([
				'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
				'alert-type' => 'error'
			]);
		}
	}
	
	
	public function AkreditasiPT(string $id_pts)
{
	$pt = PT::where('id_pts', $id_pts)->first();

	$box = AkreditasiPT::with('lembagaakreditasi', 'peringkat')
	->where('id_pts', $pt->id_pts)->first();

    $data = AkreditasiPT::with('lembagaakreditasi', 'peringkat')
	->where('id_pts', $pt->id_pts)->get();

    $data = $this->processDataAkreditasi($data, Carbon::now()->format('Y-m-d H:i:s'));

    return view('pt.akre ditasipts', compact('data', 'pt', 'box'));
}

public function AkreditasiPTnew(string $id_pts)
{
	$pt = PT::where('id_pts', $id_pts)->first();

	$box = AkreditasiPT::with('lembagaakreditasi', 'peringkat')
	->where('id_pts', $pt->id_pts)->first();

	$alllembaga = lembagaakreditasi::all();
	$allperingkat = PeringkatAkreditasi::all();

    return view('pt.modalAkreditasiPTS.NewAkreditasiPT', compact('pt', 'box', 'alllembaga', 'allperingkat'));
}
public function AkreditasiPTstore(Request $request, string $id_pts)
{
    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'id_lembaga_apt' => 'required',
        'no_sk_apt' => 'required',
        'tgl_sk_apt' => 'required|date',
        'tgl_akhir_apt' => 'required|date',
        'peringkat_apt' => 'required',
        'status_akreditasi' => 'required',
    ]);

	$id_pts = $request->id_pts ?? null;

	$id_akreditasi = $this->generateUniqueIDakreditasiPT();

    // Buat instance model AkreditasiPT untuk disimpan
    $akreditasiPT = new AkreditasiPT();
    $akreditasiPT->id_akreditasi = $id_akreditasi;
    $akreditasiPT->id_pts = $id_pts; // Atur ID PTS, sesuaikan dengan kebutuhan Anda
    $akreditasiPT->id_lembaga_apt = $request->id_lembaga_apt;
    $akreditasiPT->no_sk_apt = $request->no_sk_apt;
    $akreditasiPT->tgl_sk_apt = $request->tgl_sk_apt;
    $akreditasiPT->tgl_akhir_apt = $request->tgl_akhir_apt;
    $akreditasiPT->peringkat_apt = $request->peringkat_apt;
    $akreditasiPT->status_akreditasi = $request->status_akreditasi;

    // Simpan data ke dalam database
    $akreditasiPT->save();

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses
	return redirect()->route('akreditasipt', ['id_pts' => $akreditasiPT->id_pts])->with('success', 'Data berhasil dibuat');
}

public function AkreditasiPTedit(string $id_akreditasi)
{
	$box = AkreditasiPT::with('lembagaakreditasi', 'peringkat')
	->where('id_akreditasi', $id_akreditasi)->first();

	$pt = PT::where('id_pts', $box->id_pts)->first();

	$alllembaga = lembagaakreditasi::all();
	$allperingkat = PeringkatAkreditasi::all();

    return view('pt.modalAkreditasiPTS.EditAkreditasiPT', compact('pt', 'box', 'alllembaga', 'allperingkat'));
}
public function AkreditasiPTupdate(Request $request, string $id_akreditasi)
{
    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'id_lembaga_apt' => 'required',
        'no_sk_apt' => 'required',
        'tgl_sk_apt' => 'required|date',
        'tgl_akhir_apt' => 'required|date',
        'peringkat_apt' => 'required',
        'status_akreditasi' => 'required',
    ]);

	$akreditasiPT = AkreditasiPT::find($id_akreditasi);

    // Buat instance model AkreditasiPT untuk disimpan
    $akreditasiPT->id_lembaga_apt = $request->id_lembaga_apt;
    $akreditasiPT->no_sk_apt = $request->no_sk_apt;
    $akreditasiPT->tgl_sk_apt = $request->tgl_sk_apt;
    $akreditasiPT->tgl_akhir_apt = $request->tgl_akhir_apt;
    $akreditasiPT->peringkat_apt = $request->peringkat_apt;
    $akreditasiPT->status_akreditasi = $request->status_akreditasi;

    // Simpan data ke dalam database
    $akreditasiPT->save();

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses
	return redirect()->route('akreditasipt', ['id_pts' => $akreditasiPT->id_pts])->with('success', 'Data berhasil dibuat');
}
public function DeleteAkreditasi(Request $request, $id_akreditasi)
    {
        try {
			// Hapus data dari tbl_yayasan_pt
			$akreditasi = AkreditasiPT::findOrFail($id_akreditasi);
			if ($akreditasi->delete()) {
				return redirect()->route('akreditasipt', ['id_pts' => $akreditasi->id_pts])->with([
					'message' => 'Data berhasil dihapus',
					'alert-type' => 'success'
				]);
			} else {
				return redirect()->route('akreditasipt', ['id_pts' => $akreditasi->id_pts])->with([
					'message' => 'Terdapat kendala saat menghapus, coba ulangi lagi!',
					'alert-type' => 'error'
				]);
			}
		} catch (\Exception $e) {
			return redirect()->route('akreditasipt', ['id_pts' => $akreditasi->id_pts])->with([
				'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
				'alert-type' => 'error'
			]);
		}
    }

public function DaftarBP(string $id_pts)
{
    // Ambil data PT berdasarkan id_pts
    $pt = PT::where('id_pts', $id_pts)->first();

    // Ambil data dari tabel YayasanPT
    $bp = YayasanPT::all();

    // Mengirimkan data ke view 'pt.daftarbp'
    return view('pt.daftarbp', compact('pt', 'bp'));
}
public function DaftarBPstore(Request $request, string $id_pts)
{
	
    $idpts = $request->input('id_pts');
    $idbp = $request->input('id_bp');

    // Lakukan validasi atau operasi lain yang Anda perlukan
	$perguruanTinggi = PT::findOrFail($id_pts);

    // Contoh operasi menyimpan data ke database
    // Misalnya, Anda ingin menyimpan idbp ke dalam tabel tertentu
    $perguruanTinggi = PT::where('id_pts', $idpts)->first();
    if ($perguruanTinggi) {
        $perguruanTinggi->id_bp_pts = $idbp;
        $perguruanTinggi->save();
    }

    // Anda dapat menambahkan logika lain sesuai kebutuhan

    // Redirect atau kembali ke halaman yang sesuai
    return redirect()->back()->with('success', 'Data telah berhasil disimpan.');
}
public function CatatanPT(string $id_pts)
{
    // Ambil data PT berdasarkan id_pts
    $pt = PT::where('id_pts', $id_pts)->first();

    // Mengirimkan data ke view 'pt.daftarbp'
    return view('pt.modalCatatanPT.catatanpt', compact('pt'));
}

public function CatatanPTstore(Request $request, string $id_pts)
{
    // Validasi data yang diterima dari permintaan
    $validatedData = $request->validate([
        'keterangan' => 'required|max:255',
    ]);

    // Ambil data PT berdasarkan id_pts
    $pt = PT::where('id_pts', $id_pts)->first();

    // Jika data PT ditemukan, Anda dapat melanjutkan dengan operasi yang diperlukan
    if ($pt) {
        // Lakukan operasi lain yang Anda perlukan di sini, seperti menyimpan data ke dalam basis data
        // Misalnya, Anda dapat menyimpan keterangan ke dalam kolom 'keterangan' pada tabel PT
        $pt->keterangan = $validatedData['keterangan'];
        $pt->save();

        // Mengirimkan data ke view 'pt.modalCatatanPT.catatanpt'
		return redirect()->route('listpts')->with('success', 'Data berhasil disimpan');

    } else {
        // Jika data PT tidak ditemukan, Anda dapat mengambil tindakan yang sesuai, seperti menampilkan pesan kesalahan
        return redirect()->back()->with('error', 'PT tidak ditemukan.');
    }
}

public function CatatanPTedit(string $id_pts)
{
    // Ambil data PT berdasarkan id_pts
    $pt = PT::where('id_pts', $id_pts)->first();

    // Mengirimkan data ke view 'pt.daftarbp'
    return view('pt.modalCatatanPT.catatanptedit', compact('pt'));
}
public function CatatanPTupdate(Request $request, string $id_pts)
{
    // Validasi data yang diterima dari permintaan
    $validatedData = $request->validate([
        'keterangan' => 'required|max:255',
    ]);

    // Ambil data PT berdasarkan id_pts
    $pt = PT::where('id_pts', $id_pts)->first();

    // Jika data PT ditemukan, Anda dapat melanjutkan dengan operasi yang diperlukan
    if ($pt) {
        // Lakukan operasi lain yang Anda perlukan di sini, seperti menyimpan data ke dalam basis data
        // Misalnya, Anda dapat menyimpan keterangan ke dalam kolom 'keterangan' pada tabel PT
        $pt->keterangan = $validatedData['keterangan'];
        $pt->save();

        // Mengirimkan data ke view 'pt.modalCatatanPT.catatanpt'
		return redirect()->route('listpts')->with('success', 'Data berhasil disimpan');

    } else {
        // Jika data PT tidak ditemukan, Anda dapat mengambil tindakan yang sesuai, seperti menampilkan pesan kesalahan
        return redirect()->back()->with('error', 'PT tidak ditemukan.');
    }
}

public function AkreditasiPS(string $id_prodi_pts)
{
	$ps = ProdiPT::where('id_prodi_pts', $id_prodi_pts)->first();

	$box = AkreditasiPS::with('lembagaakreditasiprodi', 'peringkat')
	->where('id_prodi_pts', $ps->id_prodi_pts)->first();

    $data = AkreditasiPS::with('lembagaakreditasiprodi', 'peringkat')
	->where('id_prodi_pts', $ps->id_prodi_pts)->get();

	$pt = PT::where('id_pts', $ps->id_pts)->first();

    $data = $this->processDataAkreditasiPS($data, Carbon::now()->format('Y-m-d H:i:s'));

    return view('pt.akreditasiprodi', compact('data', 'ps', 'box' ,'pt'));
}

public function AkreditasiPSnew(string $id_prodi_pts)
{
	$ps = ProdiPT::where('id_prodi_pts', $id_prodi_pts)->first();

	$box = AkreditasiPS::with('lembagaakreditasiprodi', 'peringkat')
	->where('id_prodi_pts', $id_prodi_pts)->first();

	$alllembaga = lembagaakreditasiprodi::all();
	$allperingkat = PeringkatAkreditasi::all();

	$pt = PT::where('id_pts', $ps->id_pts)->first();

    return view('pt.modalAkreditasiPS.NewAkreditasiPS', compact('ps', 'box', 'alllembaga', 'allperingkat' ,'pt'));
}
public function AkreditasiPSstore(Request $request, string $id_prodi_pts)
{
    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'id_lembaga_aps' => 'required',
        'no_sk_aps' => 'required',
        'tgl_sk_aps' => 'required|date',
        'tgl_akhir_aps' => 'required|date',
        'peringkat_aps' => 'required',
        'status_akreditasi_aps' => 'required',
    ]);

	$id_prodi_pts = $request->id_prodi_pts ?? null;

	$id_akreditasi = $this->generateUniqueIDakreditasiPT();

    // Buat instance model AkreditasiPT untuk disimpan
    $akreditasiPS = new AkreditasiPS();
    $akreditasiPS->id_akreditasi = $id_akreditasi;
    $akreditasiPS->id_prodi_pts = $id_prodi_pts; // Atur ID PTS, sesuaikan dengan kebutuhan Anda
    $akreditasiPS->id_lembaga_aps = $request->id_lembaga_aps;
    $akreditasiPS->no_sk_aps = $request->no_sk_aps;
    $akreditasiPS->tgl_sk_aps = $request->tgl_sk_aps;
    $akreditasiPS->tgl_akhir_aps = $request->tgl_akhir_aps;
    $akreditasiPS->peringkat_aps = $request->peringkat_aps;
    $akreditasiPS->status_akreditasi_aps = $request->status_akreditasi_aps;

    // Simpan data ke dalam database
    $akreditasiPS->save();

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses
	return redirect()->route('akreditasips', ['id_prodi_pts' => $akreditasiPS->id_prodi_pts])->with('success', 'Data berhasil dibuat');
}

public function AkreditasiPSedit(string $id_akreditasi)
{
	$box = AkreditasiPS::with('lembagaakreditasiprodi', 'peringkat')
	->where('id_akreditasi', $id_akreditasi)->first();

	$ps = ProdiPT::where('id_prodi_pts', $box->id_prodi_pts)->first();

	$alllembaga = lembagaakreditasiprodi::all();
	$allperingkat = PeringkatAkreditasi::all();

	$pt = PT::where('id_pts', $ps->id_pts)->first();

    return view('pt.modalAkreditasiPS.EditAkreditasiPS', compact('pt', 'box', 'alllembaga', 'allperingkat', 'ps'));
}
public function AkreditasiPSupdate(Request $request, string $id_akreditasi)
{
    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'id_lembaga_aps' => 'required',
        'no_sk_aps' => 'required',
        'tgl_sk_aps' => 'required|date',
        'tgl_akhir_aps' => 'required|date',
        'peringkat_aps' => 'required',
        'status_akreditasi_aps' => 'required',
    ]);

	$akreditasiPS = AkreditasiPS::find($id_akreditasi);

    // Buat instance model AkreditasiPT untuk disimpan
    $akreditasiPS->id_lembaga_apt = $request->id_lembaga_aps;
    $akreditasiPS->no_sk_apt = $request->no_sk_aps;
    $akreditasiPS->tgl_sk_apt = $request->tgl_sk_aps;
    $akreditasiPS->tgl_akhir_apt = $request->tgl_akhir_aps;
    $akreditasiPS->peringkat_apt = $request->peringkat_aps;
    $akreditasiPS->status_akreditasi = $request->status_akreditasi_aps;

    // Simpan data ke dalam database
    $akreditasiPS->save();

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses
	return redirect()->route('akreditasips', ['id_prodi_pts' => $akreditasiPS->id_prodi_pts])->with('success', 'Data berhasil dibuat');
}

public function DeleteAkreditasiPS(Request $request, $id_akreditasi)
    {
        try {
			// Hapus data dari tbl_yayasan_pt
			$akreditasips = AkreditasiPS::findOrFail($id_akreditasi);
			if ($akreditasips->delete()) {
				return redirect()->route('')->with([
					'message' => 'Data berhasil dihapus',
					'alert-type' => 'success'
				]);
			} else {
				return redirect()->route('akreditasips', ['id_prodi_pts' => $akreditasips->id_prodi_pts])->with([
					'message' => 'Terdapat kendala saat menghapus, coba ulangi lagi!',
					'alert-type' => 'error'
				]);
			}
		} catch (\Exception $e) {
			return redirect()->route('akreditasips', ['id_prodi_pts' => $akreditasips->id_prodi_pts])->with([
				'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
				'alert-type' => 'error'
			]);
		}
    }

public function DeletePT($id_pts){
    try {
        // Hapus data ProdiPT dan AkreditasiPS terkait dengan ID PT
        $prodi = ProdiPT::where('id_pts', $id_pts)->first();
        if ($prodi) {
            AkreditasiPS::where('id_prodi_pts', $prodi->id_prodi_pts)->delete();
            $prodi->delete();
        }

        // Hapus data AkreditasiPT
        $akreditasi = AkreditasiPT::where('id_pts', $id_pts)->first();
        if ($akreditasi) {
            $akreditasi->delete();
        }

        // Hapus data dari tabel PT
        $listpt = PT::findOrFail($id_pts);
        if ($listpt->delete()) {
            return redirect()->route('listpts')->with([
                'message' => 'Data berhasil dihapus',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('listpts')->with([
                'message' => 'Terdapat kendala saat menghapus, coba ulangi lagi!',
                'alert-type' => 'error'
            ]);
        }
    } catch (\Exception $e) {
        return redirect()->route('listpts')->with([
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'alert-type' => 'error'
        ]);
    }
}


private function processDataRekapList($data, $DATE_NOW) {
	foreach ($data as $row) {
		$END_DATE = $row->tgl_akhir_apt;
		$START_DATE = $row->tgl_sk_apt;
		$peringkat_apt = $row->nm_peringkat;

		if ($END_DATE) {
			$ket = $this->cek_apt($DATE_NOW, $START_DATE, $END_DATE);
		} else {
			$ket = "secondary";
		}

		if (!$peringkat_apt) {
			$peringkat_apt = "Belum";
		}

		// Tambahkan informasi akreditasi ke dalam objek data
		$row->ket = $ket;
		$row->peringkat_apt = $peringkat_apt;
	}

	return $data;
}

	// Fungsi pribadi untuk pengolahan data
	private function processDataRekapAktif($data, $DATE_NOW) {
		foreach ($data as $row) {
			$END_DATE = $row->tgl_akhir_apt;
			$START_DATE = $row->tgl_sk_apt;
			$peringkat_apt = $row->nm_peringkat;
	
			if ($END_DATE) {
				$ket = $this->cek_apt($DATE_NOW, $START_DATE, $END_DATE);
			} else {
				$ket = "secondary";
			}
	
			if (!$peringkat_apt) {
				$peringkat_apt = "Belum";
			}
	
			// Tambahkan informasi akreditasi ke dalam objek data
			$row->ket = $ket;
			$row->peringkat_apt = $peringkat_apt;
		}
	
		return $data;
	}
	
	private function processDataBermasalahTutup($data, $DATE_NOW) {
		foreach ($data as $row) {
			$END_DATE = $row->tgl_akhir_apt;
			$START_DATE = $row->tgl_sk_apt;
	
			if ($END_DATE) {
				$ket = $this->cek_apt($DATE_NOW, $START_DATE, $END_DATE);
			} else {
				$ket = "secondary";
			}
	
			$peringkat_apt = $row->nm_peringkat ? $row->nm_peringkat : "Belum";
	
			// Tambahkan informasi akreditasi ke dalam objek data
			$row->ket = $ket;
			$row->peringkat_apt = $peringkat_apt;
		}
	
		return $data;
	}
	
	private function processDataAkreditasi($row, $DATE_NOW) {
		// Periksa jenis variabel sebelum mengakses properti
		if (is_object($row) && property_exists($row, 'tgl_akhir_apt')) {
			// Pastikan bahwa nilai properti tgl_akhir_apt bukan boolean
			if (!is_bool($row->tgl_akhir_apt)) {
				$END_DATE = Carbon::parse($row->tgl_akhir_apt); // Pastikan format tanggal yang benar
				$START_DATE = Carbon::parse($row->tgl_sk_apt); // Jika diperlukan, pastikan format tanggal yang benar
				$peringkat_apt = $row->nm_peringkat;
	
				if ($END_DATE->greaterThan($DATE_NOW)) {
					$ket = $this->cek_apt($DATE_NOW, $START_DATE, $END_DATE);
				} else {
					$ket = "secondary";
				}
	
				if (!$peringkat_apt) {
					$peringkat_apt = "Belum";
				}
	
				// Tambahkan informasi akreditasi ke dalam objek data
				$row->ket = $ket;
				$row->peringkat_apt = $peringkat_apt;
			} else {
				// Tangani kasus ketika properti tgl_akhir_apt adalah boolean
				// Contoh: jika benar, tidak ada tindakan yang perlu diambil, atau lakukan apa yang sesuai dengan logika aplikasi Anda.
			}
		}
	
		return $row;
	}

	private function processDataAkreditasiPS($row, $DATE_NOW) {
		// Periksa jenis variabel sebelum mengakses properti
		if (is_object($row) && property_exists($row, 'tgl_akhir_aps')) {
			// Pastikan bahwa nilai properti tgl_akhir_apt bukan boolean
			if (!is_bool($row->tgl_akhir_aps)) {
				$END_DATE = Carbon::parse($row->tgl_akhir_aps); // Pastikan format tanggal yang benar
				$START_DATE = Carbon::parse($row->tgl_sk_aps); // Jika diperlukan, pastikan format tanggal yang benar
				$peringkat_aps = $row->nm_peringkat;
	
				if ($END_DATE->greaterThan($DATE_NOW)) {
					$ket = $this->cek_apt($DATE_NOW, $START_DATE, $END_DATE);
				} else {
					$ket = "secondary";
				}
	
				if (!$peringkat_aps) {
					$peringkat_aps = "Belum";
				}
	
				// Tambahkan informasi akreditasi ke dalam objek data
				$row->ket = $ket;
				$row->peringkat_aps = $peringkat_aps;
			} else {
				// Tangani kasus ketika properti tgl_akhir_apt adalah boolean
				// Contoh: jika benar, tidak ada tindakan yang perlu diambil, atau lakukan apa yang sesuai dengan logika aplikasi Anda.
			}
		}
	
		return $row;
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
	
	private function generateUniqueIDprodiPTS()
	{
		do {
			$uniqueID = mt_rand(100000000000, 999999999999); // Generate ID secara acak
		} while (ProdiPT::where('id_prodi_pts', $uniqueID)->exists()); // Periksa keberadaan ID di tabel AktaYYS saja

		return $uniqueID;
	}
	private function generateUniqueIDakreditasiPT()
	{
		do {
			$uniqueID = mt_rand(100000000000, 999999999999); // Generate ID secara acak
		} while (AkreditasiPT::where('id_akreditasi', $uniqueID)->exists()); // Periksa keberadaan ID di tabel AktaYYS saja

		return $uniqueID;
	}
	private function generateUniqueIDpt()
    {
        do {
            $uniqueID = mt_rand(100000000000, 999999999999);
        } while (PT::where('id_pts', $uniqueID)->exists());

        return $uniqueID;
    }
}
