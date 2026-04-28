<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'angkatan',
        'jenjang',
        'nis',
        'nisn',
        'name',
        'tempat_lahir',
        'tanggal',
        'jk',
        'agama',
        'status_klrga',
        'anak_ke',
        'alamat',
        'telp',
        'asal_sekolah',
        'diterima_di_kelas',
        'diterima_tgl',
        'ayah',
        'ibu',
        'alamat_ortu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'telp_ortu',
        'nama_wali',
        'alamat_wali',
        'pekerjaan_wali',
        'telp_wali',
        'ket',
    ];
}
