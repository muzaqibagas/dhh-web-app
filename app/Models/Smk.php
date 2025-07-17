<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smk extends Model
{
    protected $table = 'smks';
    protected $fillable = [
        'id_jenjang',
        'id_semester', 
        'id_matakuliah',
    ];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }
    
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }
    
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah');
    }
}