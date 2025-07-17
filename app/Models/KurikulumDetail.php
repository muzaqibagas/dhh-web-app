<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KurikulumDetail extends Model
{
    protected $table = 'kurikulum_details';
    protected $fillable = [
        'id_smk',
        'id_kategorikompetensi',
        'deskripsi',
    ];

    public function smk()
    {
        return $this->belongsTo(Smk::class, 'id_smk');
    }
    
    public function kategorikompetensi()
    {
        return $this->belongsTo(KategoriKompetensi::class, 'id_kategorikompetensi');
    }
}
