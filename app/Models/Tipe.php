<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    protected $table = 'tipe';

    protected $fillable = [
        'nama',
    ];

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'id_tipe');
    }
}
