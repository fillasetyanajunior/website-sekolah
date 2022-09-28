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
        'matapelajaran',
        'jurusan',
        'guru',
        'tahun',
        'kelas',
        'tanggal',
        'semester',
        'jam',
        'keterangan',
    ];
}
