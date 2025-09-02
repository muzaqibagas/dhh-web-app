<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'users';
    protected $fillable = [
        'id_jenjang',
        'nim', 
        'nama', 
        'no_hp', 
        'alamat', 
        'tanggal_lahir', 
        'angkatan',
        'status', 
        'username', 
        'email', 
        'password',
        'jenis_kelamin', 
        'role', 
        'foto',
        'tanda_tangan_img',
        'tanda_tangan', 
        'verification_token',
    ];    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }    

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }    

    public function kontenDept() {
        return $this->hasMany(KontenDept::class, 'id_user');
    }

    public function reviewAlumni() {
        return $this->hasMany(ReviewAlumni::class, 'id_user');
    }
}
