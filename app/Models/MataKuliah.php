<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id_kategorimk', 
        'kode', 
        'nama', 
        'sks', 
        'prasyarat', 
        'deskripsi',
    ];

    public function semester() {
        return $this->belongsTo(Semester::class, 'id_semester');
    }
}
