<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('syaratujian', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_mahasiswa');
            $table->foreignId('id_moderator')->nullable();
            $table->foreignId('id_penguji')->nullable();
            $table->foreignId('id_penandatanganundangan')->nullable();

            $table->enum('jenis_ujian', ['kolokium', 'seminar', 'komprehensif']);
            $table->string('ruangan')->nullable();
            $table->string('formulir')->nullable();
            $table->text('alasan_formulir')->nullable();

            $table->string('makalah')->nullable();
            $table->text('alasan_makalah')->nullable();

            $table->string('bukti_sks')->nullable();
            $table->text('alasan_bukti_sks')->nullable();

            $table->string('bukti_spp')->nullable();
            $table->text('alasan_bukti_spp')->nullable();

            $table->string('bukti_kehadiran')->nullable();
            $table->text('alasan_bukti_kehadiran')->nullable();

            $table->enum('status', ['belum_mendaftar', 'pending', 'disetujui', 'ditolak'])->default('belum_mendaftar');
            $table->enum('bap', ['belum_melaksanakan', 'diterima', 'ditolak'])->default('belum_melaksanakan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_ujians');
    }
};
