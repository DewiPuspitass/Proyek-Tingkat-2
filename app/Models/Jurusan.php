<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_jurusan'];

    public function lowongan()
    {
        return $this->belongsToMany(LowonganKerja::class, 'lowongan_jurusan', 'jurusan_id', 'lowongan_id');
    }
}
