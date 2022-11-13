<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOffance extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'id_siswa',
        'skor',
        'jenis_pelanggaran',
        'pilihan_pelapor',
        'pelapor',
        'pembinaan',
        'pembinaan_lainnya',
        'keterangan',
    ];
}
