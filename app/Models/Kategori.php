<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = [
        'id_tipe',
        'nama',
    ];

    public function tipe()
    {
        return $this->belongsTo(Tipe::class, 'id_tipe');
    }

    public function staff()
    {
        return $this->hasMany(StaffDept::class, 'id_kategori');
    }
}
