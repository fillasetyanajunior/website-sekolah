<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nuptk',
        'nip',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_hp',
        'email',
        'wali_kelas',
        'wali_jurusan',
        'wali_no_kelas',
        'status_pegawai',
        'jabatan',
        'avatar',
    ];
}
