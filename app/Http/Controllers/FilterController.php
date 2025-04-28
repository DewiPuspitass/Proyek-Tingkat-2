<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\LowonganJurusan;

class FilterController extends Controller
{
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

// public function getLowongan(Request $request)
// {
//     $selectedJurusan = $request->input('jurusan', []);

//     $lowongan = LowonganJurusan::when(!empty($selectedJurusan), function ($query) use ($selectedJurusan) {
//         return $query->whereHas('jurusan', function ($q) use ($selectedJurusan) {
//             $q->whereIn('jurusan_id', $selectedJurusan);
//         });
//     })->get();

//     return response()->json($lowongan);
// }

public function getRole()
{
    return response()->json([
        'role' => 'admin'
    ]);
}


}
