<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';
    protected $fillable = ['nama'];

    public function staff()
    {
        return $this->hasMany(StaffDept::class, 'id_jabatan');
    }
}
