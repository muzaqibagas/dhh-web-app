<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenJenjang extends Model
{
    protected $table = 'konten_jenjangs';
    protected $fillable = [
        'id_jenjang', 
        'profil',
        'foto',
        'visi',
        'misi',
        'tujuanpendidikan',
        'kompetensilulusan',
        'capaianpembelajaran',
        'leaflet',
        'sertifikatakreditasi',
        'deskripsiakreditasi',
    ];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }
}

