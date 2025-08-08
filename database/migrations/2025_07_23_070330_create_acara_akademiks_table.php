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
        Schema::create('acara_akademiks', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_mahasiswa')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_staffdept')->constrained('staff_depts')->onDelete('cascade');
            $table->foreignId('id_kolokiummhs')->constrained('kolokiummhs')->onDelete('cascade');                        
            $table->foreignId('id_seminar')->constrained('seminars')->onDelete('cascade');
            $table->foreignId('id_sidang')->constrained('sidangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acara_akademiks');
    }
};
