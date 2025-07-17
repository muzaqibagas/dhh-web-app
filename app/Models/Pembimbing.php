<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    protected $table = 'pembimbings';

    protected $fillable = [
        'id_mahasiswa',
        'id_staffdept',
    ];

     public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }
    
    public function staff()
    {
        return $this->belongsTo(StaffDept::class, 'id_staffdept');
    }
}
