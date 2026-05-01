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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();        
            $table->foreignId('id_moderator')->nullable()->constrained('staff_depts')->onDelete('cascade');
            $table->foreignId('id_syarat_kolokiummhs')->nullable()->constrained('syarat_kolokiummhs')->cascadeOnDelete();
            $table->foreignId('id_syarat_seminarmhs')->nullable()->constrained('syarat_seminarmhs')->cascadeOnDelete();
            $table->foreignId('id_syarat_komprehensifmhs')->nullable()->constrained('syarat_komprehensifmhs')->cascadeOnDelete();            
            $table->foreignId('id_rubrik')->nullable()->constrained('rubriks')->onDelete('cascade');
            $table->enum('nilai', ['1','2','3','4'])->nullable();
            $table->text('catatan')->nullable();
            $table->float('score')->nullable();
            $table->float('nilai_akhir')->nullable();

            $table->unique(
                ['id_moderator','id_syarat_kolokiummhs', 'id_rubrik'],
                'unik_kolokium'
            );

            $table->unique(
                ['id_moderator','id_syarat_seminarmhs', 'id_rubrik'],
                'unik_seminar'
            );

            $table->unique(
                ['id_moderator','id_syarat_komprehensifmhs', 'id_rubrik'],
                'unik_kompre'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
