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
        'matapelajaran',
    ];

    public $timestamps = false;
}
