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
        Schema::create('kurikulum_details', function (Blueprint $table) {            
            $table->id('id');          
            $table->foreignId('id_jenjang')->nullable()->constrained('jenjangs')->onDelete('cascade');            
            $table->foreignId('id_kategorikompetensi')->constrained('kategori_kompetensis')->onDelete('cascade');            
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulum_details');
    }
};
