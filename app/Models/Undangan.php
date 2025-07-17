<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    protected $table = 'undangans';

    protected $fillable = [
        'id_acaraakademik',
        'id_pembimbing',
    ];

    public function acaraAkademik()
    {
        return $this->belongsTo(AcaraAkademik::class, 'id_acaraakademik');
    }
    
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'id_pembimbing');
    }
}
