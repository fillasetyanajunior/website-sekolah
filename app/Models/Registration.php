<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_registration',
        'kode',
        // 'pilihan_1',
        // 'pilihan_2',
        'info',
        'password',
        'is_active',
    ];
}
