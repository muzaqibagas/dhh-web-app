<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KetuaDHH extends Model
{
    use HasFactory;

    protected $table = 'ketua_dhhs';
    protected $fillable = [
        'id_user',
        'nama',
        'foto',
        'tahun_mulai',
        'tahun_selesai',
    ];
}
