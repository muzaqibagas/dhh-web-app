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
        Schema::create('kolokiummhs', function (Blueprint $table) {
            $table->id('id');            
            $table->foreignId('id_mahasiswa')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_semester')->constrained('semesters')->onDelete('cascade');
            $table->foreignId('id_pembimbing1')->constrained('staff_depts')->onDelete('cascade');
            $table->foreignId('id_pembimbing2')->nullable()->constrained('staff_depts')->onDelete('cascade');
            $table->string('nama');
            $table->string('nim');
            $table->string('alamat');
            $table->date('tanggal');            
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('judul_kolokium');
            $table->string('tipe_pelaksanaan')->default('offline');
            $table->foreignId('id_ruangan')->nullable()->constrained('ruangans')->onDelete('cascade');
            $table->string('link_meeting')->nullable();                          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolokiummhs');
    }
};
