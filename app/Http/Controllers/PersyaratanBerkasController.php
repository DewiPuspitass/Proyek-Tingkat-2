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
            'nama_berkas' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s]+$/', 'unique:'.PersyaratanBerkas::class],
        ],[

            'nama_berkas.required' => 'Nama berkas wajib diisi.',
            'nama_berkas.regex' => 'Nama berkas hanya boleh berisi huruf dan spasi.',
            'nama_berkas.max' => 'Nama berkas maksimal 255 karakter.',
            'nama_berkas.unique' => 'Nama berkas sudah tersedia.',
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
    public function edit($persyaratanBerkas)
    {

        // dd($persyaratanBerkas->id);
        // $a = PersyaratanBerkas::findOrFail(1);

        return view('persyaratan_berkas.edit', [
            'persyaratan_berkas' => PersyaratanBerkas::findOrFail($persyaratanBerkas),
        ]);


    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_berkas' => 'required|string|max:255',
        ],[
            'nama_berkas.required' => 'Nama pekerjaan wajib diisi.',
            'nama_berkas.string' => 'Nama pekerjaan harus berupa teks.',
            'nama_berkas.max' => 'Nama pekerjaan maksimal 255 karakter.',   
        ]);

        $persyaratanBerkas = PersyaratanBerkas::findOrFail($id);

        $persyaratanBerkas->update([
            'nama_berkas' => $request->input('nama_berkas'),
        ]);

        return redirect()->route('persyaratan_berkas.index')->with('success', "Persyaratan Berkas Berhasil Di Perbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $persyaratanBerkas = PersyaratanBerkas::findOrFail($id);
        $persyaratanBerkas->delete();

        return redirect()->route('persyaratan_berkas.index')->with('success', 'Persyaratan Berkas Berhasil di Hapus');
    }
}
