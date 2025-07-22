<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriStaff extends Model
{
    use HasFactory;

    protected $table = 'kategori_staffs';
    protected $fillable = [
        'nama',
    ];

    public function staff()
    {
        return $this->hasMany(StaffDept::class, 'id_kategori');
    }
}
