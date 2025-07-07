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
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('kategori');
            $table->string('foto');
            $table->string('nama');
            $table->string('nip');
            $table->string('jabatan');
            $table->string('email');
            $table->text('keahlian')->nullable();
            $table->string('sinta')->nullable();
            $table->string('google_scholar')->nullable();
            $table->string('scopus')->nullable();
            $table->string('researchgate')->nullable();
            $table->string('website')->nullable();
            $table->text('minat_penelitian')->nullable();
            $table->text('riwayat_pendidikan')->nullable();
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
