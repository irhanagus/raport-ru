<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npsn',
        'nis_nss_nds',
        'alamat',
        'desa',
        'kec',
        'kab',
        'prov',
        'kodepos',
        'telp',
        'website',
        'email',
        'kepsek',
        'niy_kepsek',
    ];
}
