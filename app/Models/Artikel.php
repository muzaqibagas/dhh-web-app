<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikels';
    protected $fillable = [
        'id_user', 
        'id_kategori_artikel', 
        'foto', 
        'judul', 
        'tanggal', 
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategoriArtikel()
    {
        return $this->belongsTo(KategoriArtikel::class, 'id_kategori_artikel');
    }
}
