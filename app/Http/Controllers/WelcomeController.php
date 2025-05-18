<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LowonganKerja;
use App\Models\Jurusan;

class WelcomeController extends Controller
{
    public function index()
    {
        $pengguna = User::all();
        $jumlahLowonganAktif = LowonganKerja::where('status', 'Aktif')->count(); // hitung total lowongan aktif
        $lowongan = LowonganKerja::latest()->take(4)->get(); // buat tampilan lowongan terbaru (boleh disaring status juga kalau mau)
        $jurusan = Jurusan::all();

        return view('welcome', compact('pengguna', 'lowongan', 'jumlahLowonganAktif', 'jurusan'));
    }
}
