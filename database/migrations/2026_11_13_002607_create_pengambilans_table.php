
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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
        Schema::dropIfExists('pengambilans');
    }
};
