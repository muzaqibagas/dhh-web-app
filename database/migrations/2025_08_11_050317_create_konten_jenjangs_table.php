<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('konten_jenjangs', function (Blueprint $table) {
        $table->id('id');
        $table->foreignId('id_jenjang')->constrained('jenjangs')->onDelete('cascade');        
        $table->text('profil')->nullable();
        $table->text('visi')->nullable();
        $table->text('misi')->nullable();
        $table->text('tujuanpendidikan')->nullable();
        $table->text('kompetensilulusan')->nullable();
        $table->text('capaianpembelajaran')->nullable();
        $table->string('foto')->nullable();
        $table->string('leaflet')->nullable();
        $table->string('sertifikatakreditasi')->nullable();
        $table->string('deskripsiakreditasi')->nullable();
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('konten_jenjangs');
    }
};
