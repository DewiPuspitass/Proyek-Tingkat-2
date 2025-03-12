<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganKerja extends Model
{
    use HasFactory;
    protected $table = 'lowongan_kerja';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function jurusan(){
        return $this->belongsToMany(Jurusan::class, 'lowongan_jurusan', 'lowongan_id', 'jurusan_id');
    }

    public function tipeLoker(){
        return $this->belongsToMany(TipeLowongan::class, 'lowongan_tipe_loker', 'lowongan_id', 'tipe_id');
    }

    public function tipePersyaratan(){
        return $this->belongsToMany(PersyaratanBerkas::class, 'lowongan_persyaratan_berkas', 'lowongan_id', 'persyaratan_berkas_id');
    }
}
