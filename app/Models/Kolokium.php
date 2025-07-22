<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolokium extends Model
{
    use HasFactory;

    protected $table = 'kolokiums';

    protected $fillable = [
        'id_ruangan',
        'tanggal',
        'waktu',
        'tempat',
        'judul_kolokium',
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
