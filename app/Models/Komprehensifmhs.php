<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komprehensifmhs extends Model
{
    use HasFactory;

    protected $table = 'komprehensifmhs';

    protected $fillable = [
        'id_mahasiswa',
        'id_moderator',
        'formulir',
        'bukti_sks',
        'bukti_spp',
        'bukti_kehadiran',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }

    public function moderator()
    {
        return $this->belongsTo(StaffDept::class, 'id_moderator');
    }
}
