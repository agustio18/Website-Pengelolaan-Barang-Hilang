<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Laporan extends Model
{
    use HasUuids;

    protected $table = 'laporans';

    protected $primaryKey = 'id_laporan';

    public $incrementing = false;

    protected $keyType = 'string';

    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'jenis_laporan',
        'nama_pelapor',
        'kontak_pelapor',
        'nama_barang',
        'id_kategori',
        'deskripsi',
        'waktu_kejadian',
        'foto',
        'status',
        'id_admin',
        'catatan',
        'lokasi',
        'verified_at'
    ];

    protected $casts = [
        'waktu_kejadian' => 'datetime',
        'verified_at' => 'datetime'
    ];


    // Relasi dengan tabel kategori
    public function kategori()
    {
        return $this->belongsTo(
            Kategori::class,
            'id_kategori',
            'id_kategori'
        );
    }


    // Relasi dengan tabel admin
    public function admin()
    {
        return $this->belongsTo(
            Admin::class,
            'id_admin',
            'id_admin'
        );
    }


    // Relasi dengan tabel pengambilan
    public function pengambilans()
    {
        return $this->hasMany(
            Pengambilan::class,
            'id_laporan',
            'id_laporan'
        );
    }
}