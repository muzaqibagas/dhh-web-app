<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRuangan extends Model
{
    use HasFactory;

    protected $table = 'jenis_ruangan';
    protected $fillable = ['ruangan_id', 'jenis'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}