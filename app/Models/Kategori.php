<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Kategori extends Model
{
    use HasUuids;

    protected $table = 'kategoris';

    protected $primaryKey = 'id_kategori';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];


    // Relasi dengan tabel laporan
    public function laporans()
    {
        return $this->hasMany(
            Laporan::class,
            'id_kategori',
            'id_kategori'
        );
    }
}