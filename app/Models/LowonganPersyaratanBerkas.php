<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganPersyaratanBerkas extends Model
{
    use HasFactory;
    protected $table = 'lowongan_persyaratan_berkas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lowongan_id',
        'persyaratan_berkas_id'
    ];
}
