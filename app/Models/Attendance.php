<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'nis',
        'mapel',
        'jurusan',
        'guru',
        'tahun',
        'kelas',
        'tanggal',
        'jam',
    ];
}
