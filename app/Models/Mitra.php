<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitras';
    protected $fillable = [
        'id_user',
        'nama',
        'foto',
    ];
}
