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
        'id_semester',
        'id_pembimbing1',
        'id_pembimbing2',
        'nama',
        'nim',
        'alamat',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'judul_tugasakhir',
        'tipe_pelaksanaan',
        'id_ruangan',
        'link_meeting',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    public function pembimbing1()
    {
        return $this->belongsTo(StaffDept::class, 'id_pembimbing1');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(StaffDept::class, 'id_pembimbing2');
    }

    public function acaraAkademik()
    {
        return $this->hasMany(AcaraAkademik::class, 'id_kolokium');
    }
}
