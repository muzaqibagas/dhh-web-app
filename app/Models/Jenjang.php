<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $table = 'jenjangs';
    protected $fillable = [
        'nama',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'jenjang_id');
    }
}
