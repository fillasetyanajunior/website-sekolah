<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    use HasFactory;
    protected $filleable = [
        'nama',
        'nuptk',
        'alamat',
        'nomer',
        'email',
        'lulusan',
        'wali_kelas',
        'wali_jurusan',
        'status',
        'foto',
        'sertifikat_pendidikan',
        'izasah',
    ];
}
