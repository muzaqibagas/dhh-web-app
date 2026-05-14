<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratSeminarmhs extends Model
{
    use HasFactory;

    protected $table = 'syarat_seminarmhs';

    protected $fillable = [
        'id_mahasiswa',
        'id_moderator',
        'id_penandatanganundangan',
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

    public function penandatanganundangan()
    {
        return $this->belongsTo(StaffDept::class, 'id_penandatanganundangan');
    }

    public function seminarmhs()
    {
        return $this->hasOne(Seminarmhs::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class, 'id_syarat_seminarmhs');
    }
}
