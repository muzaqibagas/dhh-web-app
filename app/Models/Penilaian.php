<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaians';

    protected $fillable = [
        'id_moderator',
        'id_penguji',
        'id_pembimbing1',
        'id_pembimbing2',
        'id_syarat_kolokiummhs',
        'id_syarat_seminarmhs',
        'id_syarat_komprehensifmhs',
        'kualitas_penulisan_laporan',
        'id_rubrik',
        'nilai',
        'score',
        'nilai_akhir',
        'catatan'
    ];

    protected $casts = [
        'score' => 'float',
        'nilai_akhir' => 'float',
    ];

    public function rubrik()
    {
        return $this->belongsTo(Rubrik::class, 'id_rubrik');
    }

    public function moderator()
    {
        return $this->belongsTo(StaffDept::class, 'id_moderator');
    }

    public function penguji()
    {
        return $this->belongsTo(StaffDept::class, 'id_penguji');
    }

    public function pembimbing1()
    {
        return $this->belongsTo(StaffDept::class, 'id_pembimbing1');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(StaffDept::class, 'id_pembimbing2');
    }

    public function kolokium()
    {
        return $this->belongsTo(SyaratKolokiummhs::class, 'id_syarat_kolokiummhs');
    }

    public function seminar()
    {
        return $this->belongsTo(SyaratSeminarmhs::class, 'id_syarat_seminarmhs');
    }

    public function komprehensif()
    {
        return $this->belongsTo(SyaratKomprehensifmhs::class, 'id_syarat_komprehensifmhs');
    }
}
