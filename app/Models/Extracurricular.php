<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'extra',
        'guru',
        'tahun',
        'semester',
        'angka',
        'huruf',
    ];
}
