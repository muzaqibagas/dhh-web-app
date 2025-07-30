<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulums';
    protected $fillable = [            
        'nama', 
        'tahun',         
    ];    

    public function kurikulumdetails() {
        return $this->belongsTo(KurikulumDetail::class, 'id_jenjang');
    }

    // Relasi ke MataKuliah (one to many)
    public function matakuliahs() {
        return $this->hasMany(MataKuliah::class, 'id_kurikulum');
    }
}

