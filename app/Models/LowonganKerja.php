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

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function tipeLoker(){
        return $this->belongsToMany(TipeLowongan::class, 'lowongan_tipe_loker', 'lowongan_id', 'tipe_id');
    }

    public function tipePersyaratan(){
        return $this->belongsToMany(PersyaratanBerkas::class, 'lowongan_persyaratan_berkas', 'lowongan_id', 'persyaratan_berkas_id');
    }

    public function domisiliPerusahaan()
    {
        return $this->belongsTo(Regency::class, 'domisili_perusahaan');
    }

    public function domisiliPenempatan()
    {
        return $this->belongsTo(Regency::class, 'domisili_penempatan');
    }

    public function lowonganJurusan()
    {
        return $this->hasMany(LowonganJurusan::class, 'lowongan_id');
    }
}
