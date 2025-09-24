<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $fillable = [
        'id_user', 
        'id_kategorigaleri', 
        'judul', 
        'tanggal', 
        'tipe', 
        'video', 
        'gambar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategorigaleri()
    {
        return $this->belongsTo(KategoriGaleri::class, 'id_kategorigaleri');
    }
}
