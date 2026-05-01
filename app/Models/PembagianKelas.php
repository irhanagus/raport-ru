<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianKelas extends Model
{
    use HasFactory;

    protected $table ='pembagian_kelas';
    protected $primaryKey ='id';
    protected $fillable = ['tp_id', 'jenjang', 'kelas_id', 'user_id', 'siswa_id', 'wali'];

    public function learnings()
        { 
            return $this->belongsTo(Learning::class, 'tp_id', 'id');
        }

    public function kelas()
        {
            return $this->belongsTo(kelas::class, 'kelas_id', 'id');
        }

    public function users()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }
    
    public function students()
        {
            return $this->belongsTo(Student::class, 'siswa_id', 'id');
        }
}
