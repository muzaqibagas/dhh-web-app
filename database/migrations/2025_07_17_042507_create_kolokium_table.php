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
        Schema::create('kolokiums', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_ruangan')->constrained('ruangans')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('tempat');
            $table->string('judul_kolokium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolokia');
    }
};
