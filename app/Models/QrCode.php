<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'matapelajaran',
        'jurusan',
        'kelas',
    ];

    public $timestamps = false;
}
