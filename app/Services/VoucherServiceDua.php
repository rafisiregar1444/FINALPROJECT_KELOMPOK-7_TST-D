<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class VoucherServiceDua
{
    public function pesanTiketDenganDiskon($jumlahOrang, $transportasiId)
    {
        try {
            $sql = "SELECT r.harga, r.id AS rute_id, t.id AS transportasi_id, t.name AS transportasi_name, c.name AS category_name
                    FROM rute r
                    JOIN transportasi t ON r.transportasi_id = t.id
                    JOIN category c ON t.category_id = c.id
                    WHERE t.id = ?";

            $result = DB::connection('futsal2')->select($sql, [$transportasiId]);

            if (empty($result)) {
                return ['error' => 'Transportasi tidak ditemukan.'];
            }

            $row = $result[0];
            $hargaTiket = $row->harga;
            $transportasiName = $row->transportasi_name;

            $diskonPerOrang = 1; 
            $totalHarga = $hargaTiket * $jumlahOrang;
            $totalDiskon = ($totalHarga * $diskonPerOrang * $jumlahOrang) / 100;
            $hargaAkhir = $totalHarga - $totalDiskon;

            return [
                'transportasi' => $transportasiName,
                'jumlah_orang' => $jumlahOrang,
                'harga_tiket_per_orang' => $hargaTiket,
                'total_harga' => $totalHarga,
                'diskon' => $totalDiskon,
                'harga_diskon' => $hargaAkhir
            ];
        } catch (\Exception $e) {
            return ['error' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function getCategory()
    {
        try {
            // Query untuk mengambil kategori transportasi
            $sql = "SELECT c.*, t.name AS transportasi_name
                    FROM category c
                    JOIN transportasi t ON c.id = t.category_id";

            $result = DB::connection('futsal2')->select($sql);
            return $result;
        } catch (\Exception $e) {
            return ['error' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }
}
