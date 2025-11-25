<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';
    protected $fillable = [
        'id_user', 
        'id_kategoriartikel',          
        'id_sdgs',
        'foto', 
        'judul', 
        'tanggal', 
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategoriartikel()
    {
        return $this->belongsTo(KategoriArtikel::class, 'id_kategoriartikel');                                                         
    }

    public function sdgs()
    {
        return $this->belongsTo(Sdgs::class, 'id_sdgs');
    }
}