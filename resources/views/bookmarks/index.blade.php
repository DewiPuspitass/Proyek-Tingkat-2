<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bookmarks</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/filterJurusan.js') }}"></script>

    <style>
        .opacity-50 { opacity: 0.5; }
        .pointer-events-none { pointer-events: none; }
        .cursor-not-allowed { cursor: not-allowed; }
    </style>
</head>

<body class="pt-24 bg-white min-h-screen flex flex-col"  data-is-admin="{{ auth()->check() && auth()->user()->hasRole('') ? 'true' : 'false' }}">

    {{-- Navigation --}}
    @include('layouts.navigation')

    <main class="flex-grow max-w-7xl mx-auto px-4">
        {{-- Flash Message --}}
        @if (session()->has('success'))
            <span class="flex flex-wrap items-center gap-4 mb-6 justify-center text-green-600">{{ session('success') }}</span>
        @endif

        <h2 class="text-2xl font-semibold text-orange-600 mb-6 text-center">Daftar Bookmarks</h2>

        {{-- Daftar Bookmarks --}}
        <div id="job-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookmarks as $bookmark)
                @if($bookmark->user && $bookmark->lowongan_kerja)  {{-- Pastikan objek user dan lowongan_kerja tidak null --}}
                    <div class="job-item relative bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <h3 class="text-lg font-semibold text-orange-600">{{ $bookmark->lowongan_kerja->title ?? 'No Title' }}</h3>
                        <p class="text-sm text-gray-600">{{ $bookmark->lowongan_kerja->nama_perusahaan ?? 'No Company' }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ \Carbon\Carbon::parse($bookmark->lowongan_kerja->deadline)->format('d M Y') ?? 'No Deadline' }}</p>

                        {{-- Ditutup jika deadline lewat --}}
                        @php
                            $deadline = \Carbon\Carbon::parse($bookmark->lowongan_kerja->deadline);
                            $now = \Carbon\Carbon::now();
                        @endphp

                        @if ($deadline->isPast())
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Ditutup</span>
                        @endif

                    </div>
                @endif
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $bookmarks->links() }}
        </div>

    </main>

    @include('layouts.footer')

</body>
</html>
