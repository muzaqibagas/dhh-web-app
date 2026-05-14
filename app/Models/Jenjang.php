<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $fillable = ['nama'];

    public function konten()
    {
        return $this->hasOne(KontenJenjang::class, 'id_jenjang');
    }
}
