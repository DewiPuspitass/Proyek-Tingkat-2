<head>
<script src="//unpkg.com/alpinejs" defer></script>
</head>

@if (Route::has('login'))
<nav x-data="{ open: false }" class="bg-white shadow fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <a href="/">
                <img src="{{ asset('logoSMK.png') }}" alt="Logo" style="height: 60px; width: auto;">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-4 items-center">
                @auth
                    {{-- UNIVERSAL LINKS --}}
                    <x-nav-link :href="route('beranda')" :active="request()->routeIs('beranda')">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    <x-nav-link :href="route('lowongan_pekerjaan.index')" :active="request()->routeIs('lowongan_pekerjaan.index')">
                        {{ __('Lowongan Pekerjaan') }}
                    </x-nav-link>

                    {{-- ADMIN --}}
                    @hasrole('admin')
                        <x-nav-link :href="route('lowongan_pekerjaan.create')" :active="request()->routeIs('lowongan_pekerjaan.create')">
                            {{ __('Unggah Lowongan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('tipe_lowongan.index')" :active="request()->routeIs('tipe_lowongan.index')">
                            {{ __('Tipe Lowongan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('jurusan.index')" :active="request()->routeIs('jurusan.index')">
                            {{ __('Manage Jurusan') }}
                        </x-nav-link>
                    @endhasrole

                    {{-- SISWA --}}
                    @hasrole('siswa')
                        <x-nav-link :href="route('bookmarks.index')" :active="request()->routeIs('bookmarks.index')">
                            {{ __('Markah') }}
                        </x-nav-link>
                    @endhasrole

                    {{-- SISWA --}}
                    <!-- Profile dropdown -->
                    <div x-data="{ openProfile: false }" class="relative">
                        <button @click="openProfile = !openProfile" class="flex items-center text-gray-700 hover:text-orange-600 font-semibold focus:outline-none">
                            {{ Auth::user()->name }}
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                        </button>
    
                    <div x-show="openProfile" @click.away="openProfile = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Edit Profil
                        </a>

                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            Keluar
                     </button>
                    </form>
                    </div>
                    </div>

                @else
                    {{-- GUEST --}}
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600 font-semibold transition">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-orange-500 text-white px-4 py-2 rounded-full font-semibold hover:bg-orange-600 transition">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="focus:outline-none">
                    <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open }" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden bg-white px-4 pb-4">
        @auth
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('lowongan_pekerjaan.index')" :active="request()->routeIs('lowongan_pekerjaan.*')">
                {{ __('Lowongan Pekerjaan') }}
            </x-responsive-nav-link>

            @hasrole('admin')
                <x-responsive-nav-link :href="route('lowongan_pekerjaan.create')">
                    {{ __('Unggah Lowongan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tipe_lowongan.index')">
                    {{ __('Tipe Lowongan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('jurusan.index')">
                    {{ __('Manajemen Jurusan') }}
                </x-responsive-nav-link>
            @endhasrole

            @hasrole('siswa')
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('lowongan_pekerjaan.index')">
                    {{ __('lowongan_pekerjaan') }}
                </x-responsive-nav-link>
            @endhasrole

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Keluar') }}
                </x-responsive-nav-link>
            </form>
        @else
            <x-responsive-nav-link :href="route('login')">
                {{ __('Masuk') }}
            </x-responsive-nav-link>
            @if (Route::has('register'))
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Daftar') }}
                </x-responsive-nav-link>
            @endif
        @endauth
    </div>
</nav>
@endif
