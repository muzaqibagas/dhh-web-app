<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeafletJenjang extends Model
{
    use HasFactory;

    protected $table = 'leaflet_jenjangs';

    protected $fillable = ['id_kontenjenjang', 'gambar'];

    public function kontenJenjang()
    {
        return $this->belongsTo(KontenJenjang::class, 'id_kontenjenjang');
    }
}
