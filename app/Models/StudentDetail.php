<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
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
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'dusun',
        'rw',
        'rt',
        'alamat',
        'kode_pos',
        'jurusan',
        'kelas',
        'foto',
    ];
}
