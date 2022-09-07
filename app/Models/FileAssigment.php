<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileAssigment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_assigment',
        'path',
        'extension',
    ];
    public $timestamps = false;
}
