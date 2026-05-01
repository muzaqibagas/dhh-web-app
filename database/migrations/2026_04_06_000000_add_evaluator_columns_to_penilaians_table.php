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
        Schema::table('penilaians', function (Blueprint $table) {
            $table->foreignId('id_penguji')->nullable()->after('id_moderator')->constrained('staff_depts')->onDelete('cascade');
            $table->foreignId('id_pembimbing1')->nullable()->after('id_penguji')->constrained('staff_depts')->onDelete('cascade');
            $table->foreignId('id_pembimbing2')->nullable()->after('id_pembimbing1')->constrained('staff_depts')->onDelete('cascade');

            $table->unique(['id_penguji', 'id_syarat_komprehensifmhs', 'id_rubrik'], 'unik_kompre_penguji');
            $table->unique(['id_pembimbing1', 'id_syarat_kolokiummhs', 'id_rubrik'], 'unik_kolokium_pembimbing1');
            $table->unique(['id_pembimbing2', 'id_syarat_kolokiummhs', 'id_rubrik'], 'unik_kolokium_pembimbing2');
            $table->unique(['id_pembimbing1', 'id_syarat_seminarmhs', 'id_rubrik'], 'unik_seminar_pembimbing1');
            $table->unique(['id_pembimbing2', 'id_syarat_seminarmhs', 'id_rubrik'], 'unik_seminar_pembimbing2');
            $table->unique(['id_pembimbing1', 'id_syarat_komprehensifmhs', 'id_rubrik'], 'unik_kompre_pembimbing1');
            $table->unique(['id_pembimbing2', 'id_syarat_komprehensifmhs', 'id_rubrik'], 'unik_kompre_pembimbing2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->dropUnique('unik_kompre_penguji');
            $table->dropUnique('unik_kolokium_pembimbing1');
            $table->dropUnique('unik_kolokium_pembimbing2');
            $table->dropUnique('unik_seminar_pembimbing1');
            $table->dropUnique('unik_seminar_pembimbing2');
            $table->dropUnique('unik_kompre_pembimbing1');
            $table->dropUnique('unik_kompre_pembimbing2');

            $table->dropForeign(['id_penguji']);
            $table->dropForeign(['id_pembimbing1']);
            $table->dropForeign(['id_pembimbing2']);
            $table->dropColumn(['id_penguji', 'id_pembimbing1', 'id_pembimbing2']);
        });
    }
};
