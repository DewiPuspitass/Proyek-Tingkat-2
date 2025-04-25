<x-guest-layout>

    <!-- Status Session -->
    <x-auth-session-status class="mb-4 text-green-400 font-semibold" :status="session('status')" />

    @if (session('success'))
        <div class="mb-4 text-green-400 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NIS -->
        <div>
            <x-input-label for="nis" :value="__('Nis')" class="text-white" />
            <x-text-input
                id="nis"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
                type="text"
                name="nis"
                :value="old('nis')"
                required
                autofocus
                autocomplete="name"
                placeholder="Masukkan NIS"
            />
            <x-input-error :messages="$errors->get('nis')" class="mt-2 text-red-400" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input
                id="name"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                placeholder="Masukkan Nama"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Jurusan -->
        <div>
            <x-input-label for="jurusan" :value="__('Jurusan')" class="text-white" />
            <select id="jurusan" name="jurusan" required class="block mt-1 w-full bg-white bg-opacity-20 border border-gray-300 text-black placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm">
                <option value="" disabled selected>Pilih Jurusan</option>
                @foreach ($jurusanList as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ old('jurusan') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('jurusan')" class="mt-2 text-red-400" />
        </div>

         <!-- Tahun Angkatan -->
        <div>
            <x-input-label for="tahun_angkatan" :value="__('Tahun Angkatan')" class="text-white" />
            <select id="tahun_angkatan" name="tahun_angkatan" required class="block mt-1 w-full bg-white bg-opacity-20 border border-gray-300 text-black placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm">
                <option value="" disabled selected>Pilih Tahun Angkatan</option>
                @for ($year = date('Y'); $year >= 2000; $year--)
                    <option value="{{ $year }}" {{ old('tahun_angkatan') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
            <x-input-error :messages="$errors->get('tahun_angkatan')" class="mt-2 text-red-400" />
        </div>

         <!-- No Telp -->
         <div>
            <x-input-label for="no_telp" :value="__('No Telp')" class="text-white" />
            <x-text-input
                id="no_telp"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
                type="text"
                name="no_telp"
                :value="old('no_telp')"
                required
                autofocus
                autocomplete="no_telp"
                placeholder="Masukkan No Telp"
            />
            <x-input-error :messages="$errors->get('no_telp')" class="mt-2 text-red-400" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input
                id="email"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="Masukkan Email"
            />
            @if ($errors->has('email'))
                <span class="text-red-600 text-sm">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input
                id="password"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Masukkan Password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input
                id="password_confirmation"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Konfirmasi Password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-300 hover:text-white"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-md">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
