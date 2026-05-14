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
            $table->foreignId('id_pembimbing1')->nullable()->constrained('staff_depts')->nullOnDelete();
            $table->foreignId('id_pembimbing2')->nullable()->constrained('staff_depts')->nullOnDelete();
            $table->foreignId('id_penguji')->nullable()->constrained('staff_depts')->nullOnDelete();
            $table->foreignId('id_syarat_ujian')->nullable()->constrained('syaratujian')->cascadeOnDelete();
            $table->foreignId('id_rubrik')->nullable()->constrained('rubriks')->onDelete('cascade');
            $table->enum('nilai', ['1', '2', '3', '4'])->nullable();
            $table->text('catatan')->nullable();
            $table->float('score')->nullable();
            $table->float('nilai_akhir')->nullable();

            $table->unique(
                ['id_moderator', 'id_syarat_ujian', 'id_rubrik'],
                'unik_ujian'
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
