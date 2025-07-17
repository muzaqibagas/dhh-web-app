<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcaraAkademik extends Model
{
    protected $table = 'acara_akademiks';

    protected $fillable = [
        'id_mahasiswa',
        'id_staffdept',
        'id_kolokium',
        'id_seminar',
        'id_sidang',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }

    public function staffdept()
    {
        return $this->belongsTo(StaffDept::class, 'id_staffdept');
    }
    
    public function kolokium()
    {
        return $this->belongsTo(Kolokium::class, 'id_kolokium');
    }
    
    public function seminar()
    {
        return $this->belongsTo(Seminar::class, 'id_seminar');
    }
    
    public function sidang()
    {
        return $this->belongsTo(Sidang::class, 'id_sidang');
    }
}
