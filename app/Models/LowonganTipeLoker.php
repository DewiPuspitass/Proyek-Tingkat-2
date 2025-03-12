<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganTipeLoker extends Model
{
    use HasFactory;
    protected $table = 'lowongan_tipe_loker';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lowongan_id',
        'tipe_id'
    ];

    public function lowongan()
    {
        return $this->belongsToMany(LowonganKerja::class, 'lowongan_tipe_loker', 'tipe_id', 'lowongan_id');
    }
}
