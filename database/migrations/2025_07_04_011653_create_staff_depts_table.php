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
        Schema::create('staff_depts', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_kategoristaff')->nullable()->constrained('kategori_staffs')->onDelete('cascade');
            $table->foreignId('id_divisi')->nullable()->constrained('divisis')->onDelete('set null');
            $table->string('jabatan')->nullable();
            $table->string('foto')->nullable();
            $table->string('nama')->nullable();
            $table->string('username')->unique()->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nip')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('sinta')->nullable();
            $table->string('google_scholar')->nullable();
            $table->string('scopus')->nullable();
            $table->string('researchgate')->nullable();
            $table->string('website')->nullable();
            $table->text('keahlian')->nullable();
            $table->text('publikasi')->nullable();
            $table->text('riwayat_pendidikan')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_depts');
    }
};
