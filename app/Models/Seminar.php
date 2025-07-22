<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    protected $table = 'seminars';

    protected $fillable = [
        'id_ruangan',
        'id_mahasiswa',
        'tanggal',
        'waktu',        
        'judul_seminar',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
    
    public function acaraAkademik()
    {
        return $this->hasMany(AcaraAkademik::class, 'id_kolokium');
    }
}
