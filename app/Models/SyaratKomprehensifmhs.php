<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratKomprehensifmhs extends Model
{
    protected $table = 'syarat_komprehensifmhs';

    protected $fillable = [
        'id_mahasiswa',
        'id_moderator',
        'id_penguji',
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
    
    public function penguji()
    {
        return $this->belongsTo(StaffDept::class, 'id_penguji');
    }
}
