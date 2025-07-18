<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffDept extends Model
{
    use HasFactory;

    protected $table = 'staff_depts';
    protected $fillable = [
        'id_user', 
        'id_kategori', 
        'id_divisi',
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
        'minat_penelitian', 
        'riwayat_pendidikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }
}
