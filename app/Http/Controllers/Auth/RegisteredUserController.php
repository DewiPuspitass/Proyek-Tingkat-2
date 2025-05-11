<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register',[
            'jurusanList' => Jurusan::all(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {


        $request->validate([
            'nis' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'name' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'tahun_angkatan' => ['required', 'integer'],
            'no_telp' => ['required', 'numeric', 'max:12', 'min:10','unique:'.User::class],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@smkn2cmi\.sch\.id$/', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.string' => 'NIS harus berupa teks.',
            'nis.max' => 'NIS tidak boleh lebih dari 255 karakter.',
            'nis.unique' => 'NIS sudah digunakan.',

            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'jurusan.required' => 'Jurusan wajib diisi.',
            'jurusan.string' => 'Jurusan harus berupa teks.',
            'jurusan.max' => 'Jurusan tidak boleh lebih dari 255 karakter.',

            'tahun_angkatan.required' => 'Tahun angkatan wajib diisi.',
            'tahun_angkatan.integer' => 'Tahun angkatan harus berupa angka.',

            'no_telp.required' => 'No. telepon wajib diisi.',
            'no_telp.max' => 'No. telepon tidak boleh lebih dari 12 karakter.',
            'no_telp.unique' => 'No. telepon sudah digunakan.',
            'no_tlp.numeric'=> 'No. telepon harus berupa angka.',
            'no_telp.min' => 'No. telepon tidak boleh kurang dari 10 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.regex' => 'Email harus menggunakan domain @smkn2cmi.sch.id.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);


        $user = User::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'jurusan_id' => $request->jurusan,
            'tahun_angkatan' => $request->tahun_angkatan,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('siswa');

        event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
