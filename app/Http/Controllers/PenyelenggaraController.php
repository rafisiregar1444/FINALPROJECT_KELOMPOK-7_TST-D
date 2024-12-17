<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\YayasanPT;
use App\Models\AktaYYS;
use App\Models\PengurusYYS;
use App\Models\PT;
use Datatables;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;



class PenyelenggaraController extends Controller
{
    public function list(){
		$data = DB::table('tbl_yayasan_pts')
			->leftJoin('tbl_perguruan_tinggi', 'tbl_perguruan_tinggi.id_bp_pts', '=', 'tbl_yayasan_pts.id_yys_pt')
			->orderBy('tbl_yayasan_pts.tgl_update', 'DESC')
			->select('tbl_yayasan_pts.id_yys_pt', DB::raw('MAX(tbl_yayasan_pts.nama_yys_pt) AS nama_yys_pt'), 'tbl_yayasan_pts.jenis_yys', DB::raw('GROUP_CONCAT(tbl_perguruan_tinggi.nama_pts SEPARATOR ", ") AS nama_pts'))
			->groupBy('tbl_yayasan_pts.id_yys_pt', 'tbl_yayasan_pts.jenis_yys')
			->get();
	
			foreach ($data as $item) {
				$akta = AktaYYS::where('id_yys_pt', $item->id_yys_pt)
				->orderBy('jns_akta', 'asc') // atau 'id', tergantung pada yang Anda gunakan
				->first();
				// Lakukan apa pun yang perlu Anda lakukan dengan $akta di sini
				$item->status_akta = $akta ? $akta->status_akta : null; // Menambahkan status_akta ke dalam objek $item
			}
			
			return view('penyelenggara.list', compact('data'));
	}
	
	

	public function new(){
		// Ambil satu baris data yang dibutuhkan dari tabel tbl_yayasan_pts dan tbl_perguruan_tinggi
		$data = DB::table('tbl_yayasan_pts')
			->join('tbl_perguruan_tinggi', 'tbl_perguruan_tinggi.id_bp_pts', '=', 'tbl_yayasan_pts.id_yys_pt')
			->where('tbl_yayasan_pts.id_yys_pt') // Sesuaikan dengan kolom yang diperlukan
			->first(); // Mengambil satu baris data saja
		return view('penyelenggara.new', compact('data'));
	}
	
	
	
	public function edit(string $id_yys_pt){
		$data = DB::table('tbl_yayasan_pts')
			->join('tbl_perguruan_tinggi', 'tbl_perguruan_tinggi.id_bp_pts', '=', 'tbl_yayasan_pts.id_yys_pt')
			->where('tbl_yayasan_pts.id_yys_pt', $id_yys_pt)
			->first();
			$data = YayasanPT::find($id_yys_pt);

		return view('penyelenggara.edit', compact('data'));
	}
	
	public function perubahan(string $id_yys_pt){
		$data = DB::table('tbl_yayasan_pts')
			->join('tbl_perguruan_tinggi', 'tbl_perguruan_tinggi.id_bp_pts', '=', 'tbl_yayasan_pts.id_yys_pt')
			->where('tbl_yayasan_pts.id_yys_pt', $id_yys_pt)
			->first();
			$data = YayasanPT::find($id_yys_pt);
	
		$perubahanData = DB::table('tbl_yayasan_pts')
		->join('tbl_perguruan_tinggi', 'tbl_perguruan_tinggi.id_bp_pts', '=', 'tbl_yayasan_pts.id_yys_pt')
		->join('v_akreditasi', 'v_akreditasi.id_pts', '=', 'tbl_perguruan_tinggi.id_pts') // Sesuaikan dengan nama tabel yang benar
		->get();
	
		return view('penyelenggara.perubahan', compact('data', 'perubahanData'));
	}
	
	
	public function akta(string $id_yys_pt) {
		try {
			// Mengambil data yayasan berdasarkan id_yys_pt menggunakan model YayasanPT
			$yayasanData = YayasanPT::where('id_yys_pt', $id_yys_pt)->first();
	
			// Mengambil data akta berdasarkan id_yys_pt menggunakan model AktaYYS
			$aktaData = AktaYYS::where('id_yys_pt', $id_yys_pt)
			->orderByRaw("CASE WHEN tbl_akta_yys.status_akta = 1 THEN 1
							  WHEN tbl_akta_yys.status_akta = 2 THEN 2
							  WHEN tbl_akta_yys.status_akta = 3 THEN 3
						 END")
			->get(); 
	
			return view('penyelenggara.akta', compact('yayasanData', 'aktaData'));
		} catch (\Exception $e) {
			// Tambahkan penanganan kesalahan sesuai kebutuhan Anda
			return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
		}
	}
	
	public function storeAkta(Request $request, string $id_yys_pt)
	{
		// Validasi input yang diterima
		$validatedData = $request->validate([
			'nomor_akta' => 'required|max:6',
			'tanggal_akta' => 'required|date',
			'nama_notaris' => 'required|max:150',
			'kota_notaris' => 'required|max:200',
			'kode_akta' => 'required|in:3,2,1',
			'status_akta' => 'required|in:3,2,1',
		]);

		try {
			// Menangani nilai yang mungkin null pada $id_yys_pt
			$id_yys_pt = $request->id_yys_pt ?? null;

			// Jika $id_yys_pt bernilai null, kembalikan pesan error
			if ($id_yys_pt === null) {
				return redirect()->back()->withInput()->with('error', 'ID yayasan tidak valid');
			}

			// Ubah format tanggal ke yyyy/mm/dd menggunakan Carbon
			$formattedDate = Carbon::createFromFormat('Y-m-d', $request->tanggal_akta)->format('Y/m/d');

			// Generate Unique ID (Pastikan method generateUniqueID() berfungsi dengan baik)
			$id_akta_yys = $this->generateUniqueIDakta();

			// Buat entri baru di tabel AktaYYS
			$saved = AktaYYS::create([
				'id_akta_yys' => $id_akta_yys,
				'id_yys_pt' => $id_yys_pt,
				'no_akta' => $request->nomor_akta,
				'tgl_akta' => $formattedDate,
				'nm_notaris' => $request->nama_notaris,
				'kota_notaris' => $request->kota_notaris,
				'jns_akta' => $request->kode_akta,
				'status_akta' => $request->status_akta,
				'tgl_update' => Carbon::now(), // Gunakan waktu sekarang sebagai default
			]);

			// Jika entri berhasil dibuat, kembalikan respons sukses, jika tidak, kembalikan pesan error
			if ($saved) {
				return redirect()->route('aktabp')->with('success', 'Data berhasil disimpan');
			} else {
				return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
			}
		} catch (\Exception $e) {
			// Tangani exception dengan mengembalikan pesan error
			return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
		}
	}

	public function aktaEdit(string $id_akta_yys) {
		try {
			// Mengambil data akta berdasarkan id_akta_yys menggunakan model AktaYYS
			$aktaData = AktaYYS::where('id_akta_yys', $id_akta_yys)->first();
			
			// Pastikan ada data sebelum melanjutkan
			if (!$aktaData) {
				return redirect()->back()->with('error', 'Data tidak ditemukan');
			}
	        $listAktaData = AktaYYS::where('id_yys_pt', $aktaData->id_yys_pt)
			->orderByRaw("CASE WHEN tbl_akta_yys.status_akta = 1 THEN 1
							WHEN tbl_akta_yys.status_akta = 2 THEN 2
							WHEN tbl_akta_yys.status_akta = 3 THEN 3
						END")
			->get();

			// Mengambil data yayasan berdasarkan id_yys_pt yang terkait dengan akta tersebut
			$yayasanData = YayasanPT::where('id_yys_pt', $aktaData->id_yys_pt)->first();
	
			return view('penyelenggara.aktaedit', compact('yayasanData', 'aktaData', 'listAktaData'));
		} catch (\Exception $e) {
			// Tambahkan penanganan kesalahan sesuai kebutuhan Anda
			return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
		}
	}
	
	
	public function updateAkta(Request $request, $id_akta_yys)
	{
		try {
			// Validasi data
			$validatedData = $request->validate([
				'nomor_akta' => 'required|max:6',
				'tanggal_akta' => 'required|date',
				'nama_notaris' => 'required|max:150',
				'kota_notaris' => 'required|max:200',
				'kode_akta' => 'required|in:3,2,1',
				'status_akta' => 'required|in:3,2,1',
			]);
			
			$formattedDate = Carbon::createFromFormat('Y-m-d', $request->tanggal_akta)->format('Y/m/d');

			// Ambil data yang akan diupdate
			$data = AktaYYS::find($id_akta_yys);

			if (!$data) {
				return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
			}

			// Update data berdasarkan input yang valid
			$data->no_akta = $request->nomor_akta;
			$data->tgl_akta = $formattedDate;
			$data->nm_notaris = $request->nama_notaris;
			$data->kota_notaris = $request->kota_notaris;
			$data->jns_akta = $request->kode_akta;
			$data->status_akta = $request->status_akta;
			$data->tgl_update = Carbon::now(); // Gunakan waktu sekarang sebagai default
			$data->save();

			// Berhasil update, kembalikan respons berhasil
			return redirect()->route('aktabp', ['id_yys_pt' => $data->id_yys_pt])->with('success', 'Data berhasil diupdate');
		} catch (\Exception $e) {
			// Tangani kesalahan jika terjadi
			return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
		}
	}

		
	public function deleteAkta($id_akta_yys){
		try {
			$data = AktaYYS::findOrFail($id_akta_yys);
	
			if ($data->delete()) {
				return redirect()->route('aktabp', ['id_yys_pt' => $data->id_yys_pt])->with([
					'message' => 'Data berhasil dihapus',
					'alert-type' => 'success'
				]);
			} else {
				return redirect()->route('aktabp', ['id_yys_pt' => $data->id_yys_pt])->with([
					'message' => 'Terdapat kendala, coba ulangi lagi!',
					'alert-type' => 'error'
				]);
			}
		} catch (\Exception $e) {
			return redirect()->route('aktabp')->with([
				'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
				'alert-type' => 'error'
			]);
		}
	}  

	public function aktaKUMHAM(string $id_akta_yys) {
		try {
			// Mengambil data akta berdasarkan id_akta_yys menggunakan model AktaYYS
			$aktaData = AktaYYS::where('id_akta_yys', $id_akta_yys)->first();
			
			// Pastikan ada data sebelum melanjutkan
			if (!$aktaData) {
				return redirect()->back()->with('error', 'Data tidak ditemukan');
			}
	        $listAktaData = AktaYYS::where('id_yys_pt', $aktaData->id_yys_pt)
			->get();

			// Mengambil data yayasan berdasarkan id_yys_pt yang terkait dengan akta tersebut
			$yayasanData = YayasanPT::where('id_yys_pt', $aktaData->id_yys_pt)->first();

			$pengurusData = PengurusYYS::where('id_akta_yys', $aktaData->id_akta_yys)
			->orderByRaw("CASE WHEN tbl_pengurus_yys.statusp = 1 THEN 1
							  WHEN tbl_pengurus_yys.statusp = 2 THEN 2
							  WHEN tbl_pengurus_yys.statusp = 3 THEN 3
						 END")
			->get();
			$pengurus = PengurusYYS::where('id_akta_yys', $aktaData->id_akta_yys)->first();
	
			return view('penyelenggara.aktaKUMHAM', compact('yayasanData', 'aktaData', 'listAktaData', 'pengurusData', 'pengurus'));
		} catch (\Exception $e) {
			// Tambahkan penanganan kesalahan sesuai kebutuhan Anda
			return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
		}
	}

	public function aktaKUMHAMnew(string $id_akta_yys){
		$aktaData = AktaYYS::where('id_akta_yys', $id_akta_yys)->first();
		
		$yayasanData = YayasanPT::where('id_yys_pt', $aktaData->id_yys_pt)->first();

		return view('penyelenggara.aktaKUMHAMnew', compact ('aktaData', 'yayasanData'));
	}
	

	public function aktaKUMHAMstore(Request $request, string $id_akta_yys)
	{

		// Validasi input yang diterima
		$validatedData = $request->validate([
			'namap' => 'required|max:100',
			'jabatanp' => 'required|max:70',
			'keterangan' => 'required|max:200',
			'statusp' => 'required|in:3,2,1',
		]);


		try {
			// Menangani nilai yang mungkin null pada $id_yys_pt
			$id_akta_yys = $request->id_akta_yys ?? null;

			// Jika $id_yys_pt bernilai null, kembalikan pesan error
			if ($id_akta_yys === null) {
				return redirect()->back()->withInput()->with('error', 'ID yayasan tidak valid');
			}

			// Ubah format tanggal ke yyyy/mm/dd menggunakan Carbon

			// Generate Unique ID (Pastikan method generateUniqueID() berfungsi dengan baik)
			$id_pengurus = $this->generateUniqueIDpengurus();

			// Buat entri baru di tabel AktaYYS
			$saved = PengurusYYS::create([
				'id_pengurus' => $id_pengurus,
				'id_akta_yys' => $id_akta_yys,
				'namap' => $request->namap,
				'jabatanp' => $request->jabatanp,
				'keterangan' => $request->keterangan,
				'statusp' => $request->statusp,
				'tgl_update' => Carbon::now(), // Gunakan waktu sekarang sebagai default
			]);

			// Jika entri berhasil dibuat, kembalikan respons sukses, jika tidak, kembalikan pesan error
			if ($saved) {
				return redirect()->route('aktakumham', ['id_akta_yys' => $id_akta_yys])->with('success', 'Data berhasil disimpan');
			} else {
				return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
			}
		} catch (\Exception $e) {
			// Tangani exception dengan mengembalikan pesan error
			return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
		}
	}

	public function aktaKUMHAMedit(string $id_pengurus) {
		$pengurusData = PengurusYYS::where('id_pengurus', $id_pengurus)->first();
	
		// Dapatkan data AktaYYS berdasarkan id_akta_yys dari PengurusYYS
		$aktaData = AktaYYS::where('id_akta_yys', $pengurusData->id_akta_yys)->first();

		$yayasanData = YayasanPT::where('id_yys_pt', $aktaData->id_yys_pt)->first();
		return view('penyelenggara.aktaKUMHAMedit', compact('aktaData', 'pengurusData', 'yayasanData'));
	}
	
	public function aktaKUMHAMupdate(Request $request, $id_pengurus)
	{
		try {
			// Validasi data
			$validatedData = $request->validate([
				'namap' => 'required|max:100',
				'jabatanp' => 'required|max:70',
				'keterangan' => 'required|max:200',
				'statusp' => 'required|in:3,2,1',
			]);
			
			// Ambil data yang akan diupdate
			$data = PengurusYYS::find($id_pengurus);

			if (!$data) {
				return redirect()->back()->withInput()->with('error', 'Data tidak ditemukan');
			}
			// Update data berdasarkan input yang valid
			$data->namap = $request->namap;
			$data->jabatanp = $request->jabatanp;
			$data->keterangan = $request->keterangan;
			$data->statusp = $request->statusp;
			$data->tgl_update = Carbon::now(); // Gunakan waktu sekarang sebagai default
			$data->save();

			// Berhasil update, kembalikan respons berhasil
			return redirect()->route('aktakumham', ['id_akta_yys' => $data->id_akta_yys])->with('success', 'Data berhasil disimpan');
		} catch (\Exception $e) {
			// Tangani kesalahan jika terjadi
			return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
		}
	}

	public function aktaKUMHAMdelete($id_pengurus) {
		try {
			if ($id_pengurus) {
				$data = PengurusYYS::findOrFail($id_pengurus);
				$aktadata = AktaYYS::findOrFail($data->id_akta_yys);
			
				if ($data->delete()) {
					return redirect()->route('aktakumham', ['id_akta_yys' => $aktadata->id_akta_yys])->with([
						'message' => 'Data berhasil dihapus',
						'alert-type' => 'success'
					]);
				} else {
					return redirect()->route('aktakumham', ['id_akta_yys' => $aktadata->id_akta_yys])->with([
						'message' => 'Terdapat kendala, coba ulangi lagi!',
						'alert-type' => 'error'
					]);
				}
			} else {
				return redirect()->route('aktakumham')->with([
					'message' => 'ID Pengurus tidak valid',
					'alert-type' => 'error'
				]);
			}
		} catch (\Exception $e) {
			return redirect()->route('aktakumham')->with([
				'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
				'alert-type' => 'error'
			]);
		}
	}
	
	public function ajukanKUMHAM(Request $request, string $id_pengurus)
	{		

		$idpengurus = $request->input('id_pengurus');
		$idyyspt = $request->input('id_yys_pt');

		// Lakukan validasi atau operasi lain yang Anda perlukan
		$pengurus = PengurusYYS::findOrFail($id_pengurus);

		// Contoh operasi menyimpan data ke database
		// Misalnya, Anda ingin menyimpan idbp ke dalam tabel tertentu
		$pengurus = PengurusYYS::where('id_pengurus', $idpengurus)->first();
		if ($pengurus) {
			$pengurus->id_yys_pt = $idyyspt;
			$pengurus->save();
		}
		return redirect()->back()->with('success', 'Data telah berhasil disimpan.');
	}

	public function deleteAjukanKUMHAM(Request $request, $id_pengurus)
	{
		try {
			$existingPengurus = PengurusYYS::find($id_pengurus);
	
			if ($existingPengurus) {
				// Hapus id_yys_pt
				$existingPengurus->id_yys_pt = null; // Atau sesuaikan dengan nilai default yang diinginkan
	
				// Simpan perubahan
				$existingPengurus->save();
	
				$id_akta_yys = $existingPengurus->id_akta_yys; // Misalnya, diambil dari relasi jika sudah didefinisikan
				return redirect()->route('aktakumham', ['id_akta_yys' => $id_akta_yys])->with('success', 'id_yys_pt berhasil dihapus');
			} else {
				return response()->json(['message' => 'Data tidak ditemukan'], 404);
			}
		} catch (\Exception $e) {
			return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
		}
	}
	

	public function listDataPengurus()
	{
		$data = DB::table('tbl_yayasan_pts')
			->leftJoin('tbl_pengurus_yys', 'tbl_pengurus_yys.id_yys_pt', '=', 'tbl_yayasan_pts.id_yys_pt')
			->orderByRaw("CASE WHEN tbl_pengurus_yys.statusp = 1 THEN 1
							  WHEN tbl_pengurus_yys.statusp = 2 THEN 2
							  WHEN tbl_pengurus_yys.statusp = 3 THEN 3
						ELSE 4 END")
			->select('tbl_pengurus_yys.*', 'tbl_yayasan_pts.nama_yys_pt') // Pilih kolom yang diperlukan
			->get();
		
		return view('penyelenggara.listDataPengurus', compact('data'));
	}


	public function store(Request $request)
	{
		$validatedData = $request->validate([
			'nama_yys_pt' => 'required|max:255',
			'jenis' => 'required|in:1,0',
			'alamat' => 'required|max:255',
			'kodepddikti' => 'required|max:255',
			// Tambahkan aturan validasi lainnya jika diperlukan
		]);

		$jenisYys = $request->jenis ?? null;

		if ($jenisYys !== null) {
			try {
				$id_yys_pt = $this->generateUniqueID(); // Menggunakan fungsi generateUniqueID()

				$saved = YayasanPT::create([
					'id_yys_pt' => $id_yys_pt,
					'nama_yys_pt' => $request->nama_yys_pt,
					'alamat_yys_pt' => $request->alamat,
					'kd_kl_pddikti' => $request->kodepddikti,
					'jenis_yys' => $jenisYys,
					'tgl_update' => Carbon::now(), // Gunakan waktu sekarang sebagai default
				]);

				if ($saved) {
					return redirect('listbp')->with('success', 'Data berhasil disimpan');
				} else {
					return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
				}
			} catch (\Exception $e) {
				return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
			}
		} else {
			return redirect()->back()->withInput()->with('error', 'Nilai Jenis tidak valid');
		}
	}
	

	public function update(Request $request, $id_yys_pt)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'nama_yys_pt' => 'required|max:255',
                'jenis_yys' => 'required|in:1,0',
				'alamat' => 'required|max:255',
				'kodepddikti' => 'required|max:255',
				'tgl_update' => Carbon::now(), // Gunakan waktu sekarang sebagai default
                // Aturan validasi lainnya jika diperlukan
            ]);

            // Ambil data yang akan diupdate
            $data = YayasanPT::findOrFail($id_yys_pt);

            // Update data berdasarkan input yang valid
            $data->update([
                'nama_yys_pt' => $request->nama_yys_pt,
                'jenis_yys' => $request->jenis_yys,
				'alamat_yys_pt' => $request->alamat,
				'kd_kl_pddikti' => $request->kodepddikti,
                // Atribut lainnya yang diperlukan
            ]);

            // Berhasil update, kembalikan respons berhasil
            return redirect('listbp')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
			
            // Tangani kesalahan jika terjadi
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

	public function delete($id_yys_pt){
		try {
			// Hapus data PengurusYYS terkait dengan ID AktaYYS
			$aktaYYS = AktaYYS::where('id_yys_pt', $id_yys_pt)->first();
			if ($aktaYYS) {
				PengurusYYS::where('id_akta_yys', $aktaYYS->id_akta_yys)->delete();
				$aktaYYS->delete();
			}
			
			// Hapus data dari tbl_yayasan_pt
			$yayasanPT = YayasanPT::findOrFail($id_yys_pt);
			if ($yayasanPT->delete()) {
				return redirect()->route('listbp')->with([
					'message' => 'Data berhasil dihapus',
					'alert-type' => 'success'
				]);
			} else {
				return redirect()->route('listbp')->with([
					'message' => 'Terdapat kendala saat menghapus, coba ulangi lagi!',
					'alert-type' => 'error'
				]);
			}
		} catch (\Exception $e) {
			return redirect()->route('listbp')->with([
				'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
				'alert-type' => 'error'
			]);
		}
	}
	private function generateUniqueIDpengurus()
	{
		do {
			$uniqueID = mt_rand(10000000, 99999999); // Generate ID secara acak
		} while (PengurusYYS::where('id_pengurus', $uniqueID)->exists()); // Periksa keberadaan ID di tabel AktaYYS saja

		return $uniqueID;
	}
	
	private function generateUniqueIDakta()
	{
		do {
			$uniqueID = mt_rand(100000000000, 999999999999); // Generate ID secara acak
		} while (AktaYYS::where('id_akta_yys', $uniqueID)->exists()); // Periksa keberadaan ID di tabel AktaYYS saja

		return $uniqueID;
	}



	private function generateUniqueID()
	{
		do {
			$uniqueID = mt_rand(100000000000, 999999999999); // Generate ID secara acak
		} while (YayasanPT::where('id_yys_pt', $uniqueID)->exists()); // Periksa keberadaan ID di tabel YayasanPT dan tbl_akta_yys

		return $uniqueID;
	}

}