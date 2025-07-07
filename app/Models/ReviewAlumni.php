<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewAlumni extends Model
{
    protected $table = 'review_alumnis';
    protected $fillable = [
        'id_user', 
        'nama', 
        'angkatan', 
        'review', 
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
