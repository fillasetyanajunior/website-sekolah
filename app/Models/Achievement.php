<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $fillable = [
        'kegiatan',
        'penyelenggara',
        'juara',
        'keterangan',
        'tahun',
        'tingkatan',
        'prestasi',
    ];
}
