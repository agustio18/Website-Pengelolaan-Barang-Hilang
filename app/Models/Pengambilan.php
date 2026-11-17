<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pengambilan extends Model
{
    use HasUuids;

    protected $table = 'pengambilans';

    protected $primaryKey = 'id_pengambilan';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_laporan',
        'id_admin',
        'nama_pengambil',
        'identitas_pengambil',
        'kontak_pengambil',
        'waktu_pengambilan',
        'keterangan'
    ];

    protected $casts = [
        'waktu_pengambilan' => 'datetime'
    ];


    // Relasi dengan tabel laporan
    public function laporan()
    {
        return $this->belongsTo(
            Laporan::class,
            'id_laporan',
            'id_laporan'
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
}