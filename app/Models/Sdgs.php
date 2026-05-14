<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdgs extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika mengikuti konvensi laravel)
    protected $table = 'sdgs';

    protected $fillable = [
        'nama_sdgs',
        'foto',
        'deskripsi',
    ];

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_sdgs');
    }

    public function badgeColor()
    {
        $colors = [
            1 => '#e5243b', // No Poverty
            2 => '#dda63a', // Zero Hunger
            3 => '#4c9f38', // Good Health
            4 => '#c5192d', // Quality Education
            5 => '#ff3a21', // Gender Equality
            6 => '#26bde2', // Clean Water
            7 => '#fcc30b', // Affordable Energy
            8 => '#a21942', // Decent Work
            9 => '#fd6925', // Innovation
            10 => '#dd1367', // Reduced Inequality
            11 => '#fd9d24', // Sustainable Cities
            12 => '#bf8b2e', // Responsible Consumption
            13 => '#3f7e44', // Climate Action
            14 => '#0a97d9', // Life Below Water
            15 => '#56c02b', // Life on Land
            16 => '#00689d', // Peace & Justice
            17 => '#19486a', // Partnership
        ];

        return $colors[$this->id] ?? '#333'; // default warna
    }
}
