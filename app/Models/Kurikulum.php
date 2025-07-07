<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulums';
    protected $fillable = [
        'id_user', 
        'id_jenjang', 
        'nama', 
        'tahun', 
        'judul', 
        'deskripsi',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenjang() {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }
}

