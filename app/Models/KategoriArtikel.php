<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model
{
    use HasFactory;

    protected $table = 'kategori_artikels';
    protected $fillable = [
        'nama',
    ];

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_kategoriartikel');
    }
}
