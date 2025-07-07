<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model  
{
    protected $table = 'semester';
    protected $fillable = [
        'id_kurikulum', 
        'tingkat_semester',
    ];

    public function kurikulum() {
        return $this->belongsTo(Kurikulum::class, 'id_kurikulum');
    }
}