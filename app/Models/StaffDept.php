<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffDept extends Model
{
    use HasFactory;

    protected $table = 'staff_depts';
    protected $fillable = [        
        'id_kategoristaff', 
        'id_divisi',
        'jabatan',
        'foto', 
        'nama', 
        'tanggal_lahir',
        'nip', 
        'jabatan', 
        'email',
        'keahlian', 
        'sinta', 
        'google_scholar', 
        'scopus', 
        'researchgate',
        'website', 
        'keahlian',
        'publikasi',
        'riwayat_pendidikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategoristaff()
    {
        return $this->belongsTo(KategoriStaff::class, 'id_kategoristaff');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
