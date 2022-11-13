<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nik',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'nomer_hp_siswa',
        'email',
        'nama_ibu',
        'nama_bapak',
        'nik_ibu',
        'pendidikan_ibu',
        'nik_bapak',
        'pendidikan_bapak',
        'pekerjaan_ibu',
        'pekerjaan_bapak',
        'penghasilan_ibu',
        'penghasilan_bapak',
        'nomer_hp_wali',
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
    ];
}
