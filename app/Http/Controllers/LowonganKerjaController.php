<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\LowonganKerja;
use App\Models\PersyaratanBerkas;
use App\Models\Province;
use App\Models\Regency;
use App\Models\TipeLowongan;
use Illuminate\Http\Request;

class LowonganKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lowongan_pekerjaan.index', [
            'lowongan_kerja' => LowonganKerja::with('domisiliPenempatan')->get()
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LowonganKerja $lowongan_pekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $LowonganKerja = LowonganKerja::findOrFail($id);
        $LowonganKerja->delete();

        return redirect()->route('lowongan_pekerjaan.index')->with('success', 'Lowongan Berhasil di Hapus');
    }
}
