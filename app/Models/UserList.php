<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserList extends Model
{
    use HasFactory;

    protected $fillable = [ 'id_userx', 'kode_pt', 'nama_pt', 'username', 'password', 'avatar', 'last_login', 'type', 'status_user', 'id_pass', 'date_added', 'date_updated', 'role'];
    protected $table = 'user_lists';
    protected $primaryKey = 'id_userx';
    const CREATED_AT = 'date_added'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'date_updated'; // Kolom untuk tindakan updated_at
    // Di model PT
    public $Sortable = [ 'id_userx', 'kode_pt', 'nama_pt', 'username', 'password', 'avatar', 'last_login', 'type', 'status_user', 'id_pass', 'date_added', 'date_updated', 'role'];

}