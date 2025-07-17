<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $table = 'seminars';

    protected $fillable = [
        'id_ruangan',
        'tanggal',
        'waktu',
        'tempat',
        'judul_seminar',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
    
    public function acaraAkademik()
    {
        return $this->hasMany(AcaraAkademik::class, 'id_kolokium');
    }
}
