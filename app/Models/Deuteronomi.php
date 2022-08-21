<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuteronomi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'jam',
        'matapelajaran',
        'tahun',
        'jurusan',
        'kursi',
        'ruangan',
        'kelas',
    ];
}
