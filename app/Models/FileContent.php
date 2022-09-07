<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_content',
        'path',
        'extension',
    ];
    public $timestamps = false;
}
