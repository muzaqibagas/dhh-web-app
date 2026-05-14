<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratUjian extends Model
{
    use HasFactory;

    protected $table = 'syaratujian';

    protected $fillable = [
        'id_mahasiswa',
        'id_moderator',
        'id_penguji',
        'id_penandatanganundangan',
        'jenis_ujian',
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

    // =========================
    // RELASI
    // =========================

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

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_syarat_ujian');
    }

    public function kolokiummhs()
    {
        return $this->hasOne(Kolokiummhs::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function seminarmhs()
    {
        return $this->hasOne(Seminarmhs::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function komprehensifmhs()
    {
        return $this->hasOne(Komprehensifmhs::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    // =========================
    // HELPER (BIAR ENAK DIPAKE)
    // =========================

    public function isKolokium()
    {
        return $this->jenis_ujian === 'kolokium';
    }

    public function isSeminar()
    {
        return $this->jenis_ujian === 'seminar';
    }

    public function isKomprehensif()
    {
        return $this->jenis_ujian === 'komprehensif';
    }

    // =========================
    // SCOPE (FILTER CEPAT)
    // =========================

    public function scopeKolokium($query)
    {
        return $query->where('jenis_ujian', 'kolokium');
    }

    public function scopeSeminar($query)
    {
        return $query->where('jenis_ujian', 'seminar');
    }

    public function scopeKomprehensif($query)
    {
        return $query->where('jenis_ujian', 'komprehensif');
    }
}
