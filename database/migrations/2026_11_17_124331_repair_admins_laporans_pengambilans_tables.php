<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel lama yang strukturnya belum sesuai
        Schema::dropIfExists('pengambilans');
        Schema::dropIfExists('laporans');
        Schema::dropIfExists('admins');


        // Membuat ulang tabel admins
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id_admin')->primary();

            $table->string('nama_admin');
            $table->string('email')->unique();
            $table->string('password');

            $table->timestamp('created_at')->nullable();
        });


        // Membuat ulang tabel laporans
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


        // Membuat ulang tabel pengambilans
        Schema::create('pengambilans', function (Blueprint $table) {
            $table->uuid('id_pengambilan')->primary();

            $table->foreignUuid('id_laporan')
                ->constrained('laporans', 'id_laporan');

            $table->foreignUuid('id_admin')
                ->constrained('admins', 'id_admin');

            $table->string('nama_pengambil');
            $table->string('identitas_pengambil');
            $table->string('kontak_pengambil');

            $table->dateTime('waktu_pengambilan');
            $table->text('keterangan');
        });
    }

    public function down(): void
    {
        // Hapus struktur baru
        Schema::dropIfExists('pengambilans');
        Schema::dropIfExists('laporans');
        Schema::dropIfExists('admins');


        // Kembalikan struktur tabel lama
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('pengambilans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};