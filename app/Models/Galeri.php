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

    public function getVideoAttribute($value)
    {
        if (!$value) return null;

        if (str_contains($value, 'embed')) {
            return $value;
        }

        // Convert https://www.youtube.com/watch?v=xxxx
        if (str_contains($value, 'watch?v=')) {
            $id = explode('v=', $value)[1];
            return 'https://www.youtube.com/embed/' . $id;
        }

        // Convert https://youtu.be/xxxx
        if (str_contains($value, 'youtu.be')) {
            $id = explode('youtu.be/', $value)[1];
            return 'https://www.youtube.com/embed/' . $id;
        }

        return $value;
    }

}
