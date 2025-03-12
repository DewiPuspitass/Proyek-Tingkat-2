<?php

namespace App\Http\Controllers;

use App\Models\PersyaratanBerkas;
use Illuminate\Http\Request;

class PersyaratanBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('persyaratan_berkas.index', [
            'persyaratan_berkas' => PersyaratanBerkas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('persyaratan_berkas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_berkas' => 'required|string|max:255'
        ]);

        PersyaratanBerkas::create([
            'nama_berkas' => $request->input('nama_berkas'),
        ]);

        return redirect()->route('persyaratan_berkas.index')->with('success', 'Persyaratan Berkas berhasil di tambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(PersyaratanBerkas $persyaratanBerkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersyaratanBerkas $persyaratanBerkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PersyaratanBerkas $persyaratanBerkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersyaratanBerkas $persyaratanBerkas)
    {
        //
    }
}
