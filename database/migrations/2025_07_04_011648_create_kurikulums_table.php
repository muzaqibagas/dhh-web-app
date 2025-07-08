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
        Schema::create('kurikulums', function (Blueprint $table) {
            $table->id('id');        
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_jenjang')->constrained('jenjangs')->onDelete('cascade');
            $table->string('nama');
            $table->string('tahun')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};
