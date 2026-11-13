
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->uuid('id_laporan')->primary();

            $table->enum('jenis_laporan', [
                'kehilangan',
                'penemuan'
            ]);

            $table->string('nama_pelapor');
            $table->string('kontak_pelapor');
            $table->string('nama_barang');

            $table->foreignUuid('id_kategori')
                ->constrained('kategoris', 'id_kategori');

            $table->text('deskripsi');
            $table->dateTime('waktu_kejadian');
            $table->string('foto');

            $table->enum('status', [
                'menunggu',
                'diverifikasi',
                'selesai'
            ]);

            $table->foreignUuid('id_admin')
                ->nullable()
                ->constrained('admins', 'id_admin')
                ->nullOnDelete();

            $table->text('catatan')->nullable();
            $table->string('lokasi');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('update_at')->nullable();
            $table->timestamp('verified_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
