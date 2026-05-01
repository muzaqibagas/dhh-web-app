<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class StaffDept extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staff_depts';
    
    protected $fillable = [
        'id_kategoristaff',
        'id_divisi',
        'jabatan',
        'foto', 
        'nama',
        'username',         
        'tanggal_lahir',
        'nip',     
        'email',
        'keahlian', 
        'sinta', 
        'google_scholar', 
        'scopus', 
        'researchgate',
        'website',         
        'publikasi',
        'riwayat_pendidikan',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => \Illuminate\Support\Facades\Hash::make($value),
        );
    }

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
    public function kolokium()
    {
        return $this->hasMany(SyaratKolokiummhs::class, 'id_moderator');
    }
    public function seminar()
    {
        return $this->hasMany(SyaratSeminarmhs::class, 'id_moderator');
    }
    public function komprehensif()
    {
        return $this->hasMany(SyaratKomprehensifmhs::class, 'id_moderator');
    }   
}
