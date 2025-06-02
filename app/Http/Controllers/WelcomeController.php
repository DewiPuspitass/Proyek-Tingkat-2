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
        $lowongan = LowonganKerja::where('status', 'aktif')->latest()->take(4)->get();
        $jurusan = Jurusan::all();

        return view('welcome', compact('pengguna', 'lowongan', 'jumlahLowonganAktif', 'jurusan'));
    }
}
