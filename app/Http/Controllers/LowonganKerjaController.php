<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\LowonganKerja;
use App\Models\LowonganJurusan;
use App\Models\PersyaratanBerkas;
use App\Models\Regency;
use App\Models\TipeLowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class LowonganKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $lowongan_pekerjaan = LowonganKerja::with(['domisiliPenempatan', 'jurusan'])
            ->when($search, function ($query) use ($search) {
                return $query->where('nama_pekerjaan', 'like', "%{$search}%")
                            ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                            ->orWhereHas('domisiliPenempatan', function ($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%");
                            })
                            ->orWhereHas('jurusan', function ($q) use ($search) {
                                $q->where('nama_jurusan', 'like', "%{$search}%");
                            });
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('lowongan_pekerjaan.table', compact('lowongan_pekerjaan'))->render();
        }

        return view('lowongan_pekerjaan.index', compact('lowongan_pekerjaan', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lowongan_pekerjaan.create', [
            'jurusan' => Jurusan::all(),
            'tipe_lowongan' => TipeLowongan::all(),
            'regensi' => Regency::all(),
            'persyaratan_berkas' => PersyaratanBerkas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'domisili_perusahaan' => 'required|string',
            'domisili_penempatan' => 'required|string',
            'jurusan' => 'required|array',
            'jurusan.*' => 'exists:jurusan,id',
            'tipe_lowongan' => 'required|array',
            'tipe_lowongan.*' => 'exists:tipe_lowongan,id',
            'gaji' => 'required|integer',
            'deskripsi' => 'required|string|max:255',
            'kualifikasi' => 'required|string|max:255',
            'persyaratan' => 'required|string|max:255',
            'foto_loker' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'persyaratan_berkas' => 'required|array',
            'persyaratan_berkas.*' => 'exists:persyaratan_berkas,id',
            'link_submit' => 'required|string|max:255',
            'batas_submit' => 'required|date',
        ]);


        $imagePath = $request->file('foto_loker') ? $request->file('foto_loker')->store('foto_loker', 'public') : null;

        $TambahLowongan = LowonganKerja::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'domisili_perusahaan' => $request->domisili_perusahaan,
            'domisili_penempatan' => $request->domisili_penempatan,
            'gaji' => $request->gaji,
            'tanggal_post' => now()->toDateString(),
            'deskripsi' => $request->deskripsi,
            'kualifikasi' => $request->kualifikasi,
            'persyaratan' => $request->persyaratan,
            'foto_loker' =>  $imagePath,
            'link_submit' => $request->link_submit,
            'batas_submit' => $request->batas_submit,
            'status' => 'Aktif',

        ]);


        $TambahLowongan->jurusan()->attach($request->jurusan);
        $TambahLowongan->tipeLoker()->attach($request->tipe_lowongan);
        $TambahLowongan->tipePersyaratan()->attach($request->persyaratan_berkas);


        return redirect()->route('lowongan_pekerjaan.index')->with('success', 'Lowongan berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LowonganKerja $lowongan_pekerjaan)
    {
        $lowongan_pekerjaan->load(['jurusan', 'tipeLoker', 'tipePersyaratan']);
        return view('lowongan_pekerjaan.show', compact('lowongan_pekerjaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LowonganKerja $lowongan_pekerjaan)
    {
        $lowongan_pekerjaan->load(['jurusan', 'tipeLoker', 'tipePersyaratan']);
        return view('lowongan_pekerjaan.edit', [
            'jurusan' => Jurusan::all(),
            'tipe_lowongan' => TipeLowongan::all(),
            'regensi' => Regency::all(),
            'persyaratan_berkas' => PersyaratanBerkas::all(),
        ], compact('lowongan_pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'domisili_perusahaan' => 'required|string',
            'domisili_penempatan' => 'required|string',
            'jurusan' => 'required|array',
            'jurusan.*' => 'exists:jurusan,id',
            'tipe_lowongan' => 'required|array',
            'tipe_lowongan.*' => 'exists:tipe_lowongan,id',
            'gaji' => 'required|integer',
            'deskripsi' => 'required|string|max:255',
            'kualifikasi' => 'required|string|max:255',
            'persyaratan' => 'required|string|max:255',
            'foto_loker' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'persyaratan_berkas' => 'required|array',
            'persyaratan_berkas.*' => 'exists:persyaratan_berkas,id',
            'link_submit' => 'required|string|max:255',
            'batas_submit' => 'required|date',
        ]);

        $lowongan = LowonganKerja::findOrFail($id);

        if ($request->hasFile('foto_loker')) {
            if ($lowongan->foto_loker) {
                Storage::disk('public')->delete($lowongan->foto_loker);
            }

            $imagePath = $request->file('foto_loker')->store('foto_loker', 'public');
        } else {
            $imagePath = $lowongan->foto_loker;
        }

        $lowongan->update([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'domisili_perusahaan' => $request->domisili_perusahaan,
            'domisili_penempatan' => $request->domisili_penempatan,
            'gaji' => $request->gaji,
            'tanggal_post' => now()->toDateString(),
            'deskripsi' => $request->deskripsi,
            'kualifikasi' => $request->kualifikasi,
            'persyaratan' => $request->persyaratan,
            'foto_loker' => $imagePath,
            'link_submit' => $request->link_submit,
            'batas_submit' => $request->batas_submit,
            'status' => 'Aktif',
        ]);

        $lowongan->jurusan()->sync($request->jurusan);
        $lowongan->tipeLoker()->sync($request->tipe_lowongan);
        $lowongan->tipePersyaratan()->sync($request->persyaratan_berkas);

        return redirect()->route('lowongan_pekerjaan.index')->with('success', 'Lowongan berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lowongan = LowonganKerja::findOrFail($id);

        if ($lowongan->foto_loker) {
            Storage::disk('public')->delete($lowongan->foto_loker);
        }

        $lowongan->delete();

        return redirect()->route('lowongan_pekerjaan.index')->with('success', 'Lowongan Berhasil dihapus');
    }
}
