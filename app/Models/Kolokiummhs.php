<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolokiummhs extends Model
{
    use HasFactory;

    protected $table = 'kolokiummhs';

    protected $fillable = [
        'id_ruangan',
        'id_mahasiswa',
        'id_semester',
        'id_pembimbing1',
        'id_pembimbing2',
        'id_komisipendidikan',
        'nama',
        'nim',
        'alamat',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'judul_kolokium',
        'link_meeting',
        'tipe_pelaksanaan',
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

    public function komisipendidikan()
    {
        return $this->belongsTo(StaffDept::class, 'id_komisipendidikan');
    }

    public function syaratUjian()
    {
        return $this->hasOne(SyaratUjian::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function syaratUjianKolokium()
    {
        return $this->hasOne(SyaratUjian::class, 'id_mahasiswa', 'id_mahasiswa')
            ->where('jenis_ujian', 'kolokium');
    }
}
