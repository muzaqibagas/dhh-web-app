<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smk extends Model
{
    protected $table = 'smks';
    protected $fillable = [
        'id_semester', 
        'id_matakuliah',
    ];
}