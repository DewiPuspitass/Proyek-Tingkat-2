<?php

namespace App\Http\Controllers;

use App\Models\TipeLowongan;
use Illuminate\Http\Request;

class TipeLowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tipe_lowongan.index', [
            'tipe_lowongan' => TipeLowongan::all(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipe_lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe_lowongan' => 'required|max:255',
        ],[
            'nama_tipe_lowongan.required' => 'Nama pekerjaan wajib diisi.',
            'nama_tipe_lowongan.string' => 'Nama pekerjaan harus berupa teks.',
            'nama_tipe_lowongan.max' => 'Nama pekerjaan maksimal 255 karakter.',
        ]);

        TipeLowongan::create([
            'nama_tipe_lowongan' => $request->input('nama_tipe_lowongan'),
        ]);

        return redirect()->route('tipe_lowongan.index')->with('success', 'Tipe Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipeLowongan $tipeLowongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tipeLowongan)
    {
        return view('tipe_lowongan.edit', [
            'tipe_lowongan' => TipeLowongan::findOrFail($tipeLowongan),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tipe_lowongan' => 'required|string|max:255',
        ],[
            'nama_tipe_lowongan.required' => 'Nama pekerjaan wajib diisi.',
            'nama_tipe_lowongan.string' => 'Nama pekerjaan harus berupa teks.',
            'nama_tipe_lowongan.max' => 'Nama pekerjaan maksimal 255 karakter.',
        ]);

        $persyaratanBerkas = TipeLowongan::findOrFail($id);

        $persyaratanBerkas->update([
            'nama_tipe_lowongan' => $request->input('nama_tipe_lowongan'),
        ]);

        return redirect()->route('tipe_lowongan.index')->with('success', "Tipe Lowongan Berhasil Di Perbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $persyaratanBerkas = TipeLowongan::findOrFail($id);
        $persyaratanBerkas->delete();

        return redirect()->route('tipe_lowongan.index')->with('success', 'Tipe Lowongan Berhasil di Hapus');
    }
}
