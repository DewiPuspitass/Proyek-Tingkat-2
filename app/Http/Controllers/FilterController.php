<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\LowonganJurusan;
use Illuminate\Support\Facades\Auth;
use App\Models\Regency; // Pastikan model ini sesuai dengan nama model untuk tabel regensi

class FilterController extends Controller
{
    // Removed duplicate getRole method to avoid redeclaration error

    public function getJurusan()
    {
        $jurusan = Jurusan::all();
        return response()->json($jurusan);
    }


    public function getLowongan(Request $request)
    {
        $jurusan = $request->input('jurusan', []);

        $lowongan = LowonganJurusan::with(['jurusan', 'lowongan_kerja'])
            ->when(!empty($jurusan), function ($query) use ($jurusan) {
                return $query->whereHas('jurusan', function ($q) use ($jurusan) {
                    $q->whereIn('jurusan_id', $jurusan);
                });
            })->get();

        $uniqueLowongan = $lowongan->unique('lowongan_id');

        return response()->json($uniqueLowongan->values());
    }

    public function getRole()
    {
        $user = Auth::user(); // Ambil user yang sedang login

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Debugging
        logger('User:', ['id' => $user->id, 'name' => $user->name, 'role' => $user->getRoleNames()]);

        // Ambil role pertama (gunakan getRoleNames jika menggunakan Spatie)
        $role = $user->getRoleNames()->first(); // Jika menggunakan Spatie Laravel Permission

        return response()->json([
            'role' => $role
        ]);
    }
    public function getDomisili(Request $request)
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(['error' => 'ID domisili tidak diberikan'], 400);
        }

        $domisili = Regency::find($id);

        if (!$domisili) {
            return response()->json(['error' => 'Domisili tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $domisili->id,
            'nama' => $domisili->name
        ]);
    }



}
