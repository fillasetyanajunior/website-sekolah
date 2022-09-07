<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'kode_buku',
    ];
}
