<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKompetensi extends Model
{
    protected $table = 'kategori_kompetensis';

    protected $fillable = [
        'nama',
    ];

    // Relasi ke Detail
    public function detail()
    {
        return $this->hasMany(Detail::class, 'id_kategorikompetensi');
    }
}
