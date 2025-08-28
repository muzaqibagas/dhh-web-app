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
        Schema::create('undangans', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_acara_akademik')->constrained('acara_akademiks')->onDelete('cascade');
            $table->foreignId('id_pembimbing1')->constrained('staff_depts')->onDelete('cascade');
            $table->foreignId('id_pembimbing2')->nullable()->constrained('staff_depts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undangans');
    }
};
