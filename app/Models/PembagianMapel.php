<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianMapel extends Model
{
    use HasFactory;

    protected $table = 'pembagian_mapel';
    protected $fillable = ['tp_id', 'jenjang', 'kelas_id', 'mapel_id', 'guru_id'];

    public function learning()
    {
        return $this->belongsTo(Learning::class, 'tp_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id'); // singular — 1 row = 1 mapel
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
    
}
