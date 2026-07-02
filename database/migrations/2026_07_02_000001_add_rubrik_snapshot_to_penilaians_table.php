<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->string('rubrik_nama_kriteria')->nullable()->after('id_rubrik');
            $table->integer('rubrik_bobot')->nullable()->after('rubrik_nama_kriteria');
            $table->dropForeign(['id_rubrik']);
            $table->foreign('id_rubrik')->references('id')->on('rubriks')->nullOnDelete();
        });

        DB::statement(
            'UPDATE penilaians p JOIN rubriks r ON p.id_rubrik = r.id SET p.rubrik_nama_kriteria = r.nama_kriteria, p.rubrik_bobot = r.bobot'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->dropForeign(['id_rubrik']);
            $table->foreign('id_rubrik')->references('id')->on('rubriks')->cascadeOnDelete();

            $table->dropColumn('rubrik_nama_kriteria');
            $table->dropColumn('rubrik_bobot');
        });
    }
};
