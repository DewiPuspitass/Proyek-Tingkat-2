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
            'no_telp' => ['required', 'max:12', 'unique:'.User::class],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@smkn2cmi\.sch\.id$/', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
