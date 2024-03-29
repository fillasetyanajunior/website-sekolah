<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'hari',
        'jam_start',
        'jam_end',
        'matapelajaran',
        'guru',
        'tahun',
        'jurusan',
        'no_kelas',
        'kelas',
    ];
}
