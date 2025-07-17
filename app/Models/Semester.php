<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model  
{
    protected $table = 'semester';
    protected $fillable = [        
        'tingkat_semester',
    ];
    
    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }
}