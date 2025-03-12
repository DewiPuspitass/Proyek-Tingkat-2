<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersyaratanBerkas extends Model
{
    use HasFactory;
    protected $table = 'persyaratan_berkas';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_berkas'];

}
