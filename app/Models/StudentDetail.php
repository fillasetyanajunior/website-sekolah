<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'nomer_hp',
        'email',
        'nama_ibu',
        'nama_bapak',
        'pendidikan_ibu',
        'pendidikan_bapak',
        'pekerjaan_ibu',
        'pekerjaan_bapak',
        'penghasilan_ibu',
        'penghasilan_bapak',
        'pendidikan',
        'nama_sekolah',
        'alamat',
        'jurusan',
        'kelas',
        'foto',
    ];
}
