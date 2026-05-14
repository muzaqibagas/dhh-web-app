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

    public function getBadgeColor()
    {
        // Hash nama kategori → ambil 6 digit hexadecimal
        $hash = substr(md5($this->nama), 0, 6);

        // Hasilnya jadi warna HEX tak terbatas
        return '#'.$hash;
    }
}
