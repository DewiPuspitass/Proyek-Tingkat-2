<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganJurusan extends Model
{
    use HasFactory;
    protected $table = 'lowongan_jurusan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lowongan_id',
        'jurusan_id'
    ];

    public function jurusan(){
        return $this->hasMany(Jurusan::class, 'jurusan_id', 'id');
    }

    public function lowongan_kerja(){
        return $this->hasMany(LowonganKerja::class, 'tipe_loker_id', 'id');
    }
}
