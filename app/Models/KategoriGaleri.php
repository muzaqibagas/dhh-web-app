<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGaleri extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeris';

    protected $fillable = [
        'nama',
    ];

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'id_kategorigaleri');
    }
}
