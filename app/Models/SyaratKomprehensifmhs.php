<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratKomprehensifmhs extends Model
{
    use HasFactory;

    protected $table = 'syarat_komprehensifmhs';

    protected $fillable = [
        'id_mahasiswa',
        'id_moderator',
        'id_penguji',
        'id_penandatanganundangan',
        'ruangan',
        'formulir',
        'alasan_formulir',
        'makalah',
        'alasan_makalah',
        'bukti_sks',
        'alasan_bukti_sks',
        'bukti_spp',
        'alasan_bukti_spp',  
        'bukti_kehadiran',
        'alasan_bukti_kehadiran',
        'status',
        'bap',
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

    public function penandatanganundangan()
    {
        return $this->belongsTo(StaffDept::class, 'id_penandatanganundangan');
    }

    public function komprehensifmhs()
    {
        return $this->hasone(Komprehensifmhs::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
