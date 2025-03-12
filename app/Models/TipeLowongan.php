<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeLowongan extends Model
{
    use HasFactory;
    protected $table = 'tipe_lowongan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_tipe_lowongan'];

    public function loker(){
        return $this->belongsToMany(LowonganKerja::class);
    }
}
