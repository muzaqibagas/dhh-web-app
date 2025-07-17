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
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    
    public function smk()
    {
        return $this->hasMany(Smk::class, 'id_matakuliah');
    }
}
