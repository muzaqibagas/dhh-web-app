<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenDept extends Model
{
    protected $table = 'konten_depts';
    protected $fillable = [
        'id_user', 
        'judul', 
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
