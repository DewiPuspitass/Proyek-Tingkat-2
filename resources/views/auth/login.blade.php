<x-guest-layout>

    <!-- Status Session -->
    <x-auth-session-status class="mb-4 text-green-400 font-semibold" :status="session('status')" />

    @if (session('success'))
        <div class="mb-4 text-green-400 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan Email"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" class="text-white" />
            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan Kata Sandi"
                class="mt-1 block w-full bg-white bg-opacity-20 border border-gray-300 text-white placeholder-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-md shadow-sm"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-300 hover:text-white"
                   href="{{ route('password.request') }}">
                    {{ __('Lupa Kata Sandi?') }}
                </a>
            @endif
            
            <x-primary-button class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-md">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6 text-sm text-gray-300">
            {{ __("Saya belum punya") }} <a href="{{ route('register') }}" class="text-orange-400 hover:underline">akun</a>
        </div>
    </form>

</x-guest-layout>
