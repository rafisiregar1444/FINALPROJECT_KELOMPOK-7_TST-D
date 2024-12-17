<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserList;
use App\Models\Lomba;


class LombaMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_lomba_mahasiswa', 'id_userx', 'id_lomba', 'keterangan', 'status', 'tanggal_menang_', 'tgl_dibuat', 'voucher'];
    protected $table = 'tbl_lomba_mahasiswa';
    protected $primaryKey = 'id_lomba_mahasiswa';
    const CREATED_AT = 'tgl_dibuat'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'tgl_dibuat'; // Kolom untuk tindakan updated_at

    public $Sortable =  [ 'id_lomba_mahasiswa', 'id_userx', 'id_lomba', 'keterangan', 'status', 'tanggal_menang_', 'tgl_dibuat', 'voucher'];

    public function user()
    {
        return $this->belongsTo(UserList::class, 'id_userx', 'id_userx');
    }
    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'id_lomba', 'id_lomba');
    }
}