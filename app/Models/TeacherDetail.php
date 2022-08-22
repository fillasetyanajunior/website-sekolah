<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    use HasFactory;
    protected $filleable = [
        'user_id',
        'nama',
        'nuptk',
        'alamat',
        'nomer',
        'email',
        'lulusan',
        'mapel',
        'kelas',
        'jurusan',
        'kelas_mengajar',
        'status',
        'foto',
        'sertifikat_pendidikan',
        'izasah',
    ];
}
