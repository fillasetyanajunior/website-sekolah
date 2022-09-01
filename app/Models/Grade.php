<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'matapelajaran',
        'guru',
        'tahun',
        'kelas',
        'semester',
        'angka',
        'huruf',
    ];
}
