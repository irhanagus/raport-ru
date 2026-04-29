<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_pelajaran',
        'semester',
        'tgl_bagi_raport',
        'status',
    ];
}
