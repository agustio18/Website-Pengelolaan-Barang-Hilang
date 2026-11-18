<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Dompet & Tas' => 'Dompet, tas, pouch, dan barang bawaan pribadi.',
            'Elektronik' => 'Ponsel, laptop, charger, earphone, dan perangkat elektronik.',
            'Dokumen' => 'Kartu identitas, kartu mahasiswa, surat, dan dokumen.',
            'Aksesori' => 'Jam tangan, kacamata, perhiasan, dan aksesori lainnya.',
            'Kunci' => 'Kunci kendaraan, kunci ruangan, dan gantungan kunci.',
            'Lainnya' => 'Barang yang tidak termasuk kategori lain.',
        ] as $name => $description) {
            Category::firstOrCreate(['name' => $name], ['description' => $description]);
        }
    }
}
