<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffDept extends Model
{
    protected $table = 'staff_depts';
    protected $fillable = [
        'id_user', 
        'id_kategori', 
        'id_divisi',
        'foto', 
        'nama', 
        'nip', 
        'jabatan', 
        'email',
        'keahlian', 
        'sinta', 
        'google_scholar', 
        'scopus', 
        'researchgate',
        'website', 
        'minat_penelitian', 
        'riwayat_pendidikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
