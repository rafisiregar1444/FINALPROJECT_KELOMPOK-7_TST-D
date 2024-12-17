<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class user_list extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'user_lists';

	protected $primaryKey = 'id_userx';

    protected $table = 'user_lists';     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'id_userx', 'kode_pt', 'nama_pt', 'username', 'password', 'avatar', 'last_login', 'type', 'status_user', 'id_pass', 'date_added', 'date_updated', 'role'];

    const CREATED_AT = 'date_added'; // Anda sudah menggunakan 'tgl_update' sebagai CREATED_AT
    const UPDATED_AT = 'date_updated'; // Kolom untuk tindakan updated_at
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
