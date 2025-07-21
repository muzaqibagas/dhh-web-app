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
        Schema::create('seminars', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_ruangan')->constrained('ruangans')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu');            
            $table->string('judul_seminar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }
};
