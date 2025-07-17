<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisis'; 
    protected $fillable = [
        'nama',
    ];    

    public function staff()
    {
        return $this->hasMany(StaffDept::class, 'id_divisi');
    }
}
