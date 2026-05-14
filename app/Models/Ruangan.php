<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $fillable = [
        'nama',
    ];

    public function kolokiums()
    {
        return $this->hasMany(Kolokium::class, 'id_ruangan');
    }

    public function seminars()
    {
        return $this->hasMany(Seminar::class, 'id_ruangan');
    }

    public function sidangs()
    {
        return $this->hasMany(Sidangs::class, 'id_ruangan');
    }

    public function jenis()
    {
        return $this->hasMany(JenisRuangan::class);
    }
}
