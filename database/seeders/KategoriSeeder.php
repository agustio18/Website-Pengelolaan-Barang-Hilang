<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori_data = [
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Barang elektronik seperti laptop, handphone, dan charger.'
            ],
            [
                'nama_kategori' => 'Dokumen',
                'deskripsi' => 'Dokumen pribadi seperti KTP, SIM, dan kartu mahasiswa.'
            ],
            
        ];

        foreach ($kategori_data as $data) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $data['nama_kategori']],
                ['deskripsi' => $data['deskripsi']]
            );
        }
    }
}