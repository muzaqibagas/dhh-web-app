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
        Schema::create('syarat_komprehensifmhs', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_mahasiswa')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_moderator')->nullable()->constrained('staff_depts')->onDelete('cascade');
            $table->foreignId('id_penguji')->nullable()->constrained('staff_depts')->onDelete('cascade');
            $table->string('formulir'); 
            $table->text('alasan_formulir')->nullable();
            $table->string('bukti_sks');
            $table->text('alasan_bukti_sks')->nullable();
            $table->string('bukti_spp');
            $table->text('alasan_bukti_spp')->nullable();
            $table->string('bukti_kehadiran');
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
        Schema::dropIfExists('syarat_komprehensifmhs');
    }
};
