<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulums';
    protected $fillable = [
        'id_jenjang', 
        'nama', 
        'tahun',         
    ];    

    public function jenjang() {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }
}

