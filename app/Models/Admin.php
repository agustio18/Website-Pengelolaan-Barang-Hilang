<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Admin extends Authenticatable
{
    use HasUuids;

    protected $table = 'admins';

    protected $primaryKey = 'id_admin';

    public $incrementing = false;

    protected $keyType = 'string';

    const UPDATED_AT = null;

    protected $fillable = [
        'nama_admin',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];


    // Relasi dengan tabel laporan
    public function laporans()
    {
        return $this->hasMany(
            Laporan::class,
            'id_admin',
            'id_admin'
        );
    }


    // Relasi dengan tabel pengambilan
    public function pengambilans()
    {
        return $this->hasMany(
            Pengambilan::class,
            'id_admin',
            'id_admin'
        );
    }
}