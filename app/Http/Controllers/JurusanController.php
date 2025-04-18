<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jurusan.index', [
            'jurusan' => Jurusan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ], [
            'nama_jurusan.required' => 'Nama pekerjaan wajib diisi.',
            'nama_jurusan.string' => 'Nama pekerjaan harus berupa teks.',
            'nama_jurusan.max' => 'Nama pekerjaan maksimal 255 karakter.',
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->input('nama_jurusan'),
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        dd($jurusan->id);
        return view('jurusan.edit', [
            'jurusan' => Jurusan::findOrFail($jurusan->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ],[
            'nama_jurusan.required' => 'Nama pekerjaan wajib diisi.',
            'nama_jurusan.string' => 'Nama pekerjaan harus berupa teks.',
            'nama_jurusan.max' => 'Nama pekerjaan maksimal 255 karakter.',
        ]);

        $jurusan = Jurusan::findOrFail($id);

        $jurusan->update([
            'nama_jurusan' => $request->input('nama_jurusan'),
        ]);

        return redirect()->route('jurusan.index')->with('success', "Jurusan Berhasil Di Perbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan Berhasil di Hapus');
    }
}
