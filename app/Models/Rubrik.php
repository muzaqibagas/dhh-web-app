<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubrik extends Model
{
    protected $table = 'rubriks';

    protected $fillable = [
        'nama_kriteria',
        'bobot',
        'jenis_sidang',
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_rubrik');
    }
}
