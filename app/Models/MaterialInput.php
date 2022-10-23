<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialInput extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'pembahasan',
        'kelas',
        'matapelajaran',
        'jurusan',
        'no_kelas',
        'guru',
    ];
}
