<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_guru',
        'kelas',
        'jurusan',
        'no_kelas',
        'matapelajaran',
    ];

    public $timestamps = false;
}
