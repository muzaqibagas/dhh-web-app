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
        Schema::create('konten_jenjangs', function (Blueprint $table) {
            $table->id();
            $table->text('jenjang')->nullable();
            $table->text('profil')->nullable();
            $table->string('foto')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('tujuanpendidikan')->nullable();
            $table->text('kompetensilulusan')->nullable();
            $table->text('capaianpembelajaran')->nullable();
            $table->string('leaflet')->nullable();
            $table->string('sertifikatakreditasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten_jenjangs');
    }
};
