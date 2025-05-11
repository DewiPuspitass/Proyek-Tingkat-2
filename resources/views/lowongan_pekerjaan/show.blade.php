<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Lowongan Pekerjaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="pt-24 bg-white min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('layouts.navigation')

    <main>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow space-y-8">
                <!-- Tampilkan flash message jika ada -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif



            {{-- Header: Logo + Info Umum --}}
            <div class="flex items-center gap-6">
                <img src="{{ asset('storage/' . $lowongan_pekerjaan->foto_loker) }}" class="w-24 h-24 object-contain" alt="Logo Perusahaan">
                <div>
                    <h1 class="text-2xl font-bold">{{ $lowongan_pekerjaan->nama_pekerjaan }}</h1>
                    <p class="text-gray-600">{{ $lowongan_pekerjaan->nama_perusahaan }}</p>
                    <div class="text-sm text-gray-500">
                        <p>Lokasi: {{ $lowongan_pekerjaan->domisiliPerusahaan->name }}</p>
                        <p>Penempatan: {{ $lowongan_pekerjaan->domisiliPenempatan->name }}</p>
                        <p>Gaji: Rp{{ number_format($lowongan_pekerjaan->gaji, 0, ',', '.') }}</p>
                        @php
                        $deadline = \Carbon\Carbon::parse($l->batas_submit)->endOfDay();
                    @endphp

                    @if (now()->gt($deadline))
                        <p class="text-xs text-red-500 mt-1">Batas submit sudah lewat</p>
                    @else
                        <p class="text-xs text-gray-400 mt-1">
                            {{ now()->diffForHumans($deadline, true) }} lagi batas akan berakhir
                        </p>
                    @endif
                    </div>
                </div>
            </div>

            {{-- Tipe Loker & Jurusan --}}
            @if ($lowongan_pekerjaan->tipeLoker->isNotEmpty())
                <div>
                    <p class="font-semibold">Tipe Pekerjaan:</p>
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach ($lowongan_pekerjaan->tipeLoker as $tipe)
                            <li>{{ $tipe->nama_tipe_lowongan }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($lowongan_pekerjaan->jurusan->isNotEmpty())
                <div>
                    <p class="font-semibold">Jurusan yang diterima:</p>
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach ($lowongan_pekerjaan->jurusan as $jurusan)
                            <li>{{ $jurusan->nama_jurusan }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Deskripsi Pekerjaan --}}
            <div>
                <h3 class="text-lg font-semibold">Deskripsi Pekerjaan</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $lowongan_pekerjaan->deskripsi }}</p>
            </div>

            {{-- Kualifikasi --}}
            <div>
                <h3 class="text-lg font-semibold">Kualifikasi</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $lowongan_pekerjaan->kualifikasi }}</p>
            </div>

            {{-- Berkas Tambahan --}}
            @if ($lowongan_pekerjaan->tipePersyaratan->isNotEmpty())
                <div>
                    <h3 class="text-lg font-semibold">Berkas yang Harus Dikirim</h3>
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach ($lowongan_pekerjaan->tipePersyaratan as $berkas)
                            <li>{{ $berkas->nama_berkas }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Link Submit & Batas --}}
            <div>
                <p class="text-sm">
                    Link Pengumpulan:
                    <a href="{{ $lowongan_pekerjaan->link_submit }}" class="text-blue-500 underline">
                        {{ $lowongan_pekerjaan->link_submit }}
                    </a>
                </p>
                <p class="text-sm text-gray-600">Batas submit: {{ \Carbon\Carbon::parse($lowongan_pekerjaan->batas_submit)->translatedFormat('d F Y') }}</p>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-4">
                <button class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">Lamar</button>
                <button
                    class="px-4 py-2 border border-yellow-400 text-yellow-500 rounded-lg hover:bg-yellow-100"
                    id="bookmark-button"
                    data-lowongan-id="{{ $lowongan_pekerjaan->id }}"
                    data-bookmarked="{{ auth()->check() && auth()->user()->bookmarks->contains($lowongan_pekerjaan->id) ? 'true' : 'false' }}">
                    {{ auth()->check() && auth()->user()->bookmarks->contains($lowongan_pekerjaan->id) ? 'Bookmark Saved' : 'Save to Bookmark' }}
                </button>
            </div>
        </div>
    </div>
    </main>
        <a id="wa-button" href="https://wa.link/dbsvo5" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M12.04 2c5.52 0 10 4.48 10 10 0 5.52-4.48 10-10 10-1.75 0-3.4-.46-4.86-1.32l-5.04 1.32 1.34-4.9A9.99 9.99 0 0 1 2 12c0-5.52 4.48-10 10.04-10zm0 1.75C7.25 3.75 3.75 7.26 3.75 12c0 1.69.48 3.29 1.31 4.68l-.87 3.2 3.3-.86A8.24 8.24 0 0 0 12.04 20.25c4.75 0 8.25-3.51 8.25-8.25 0-4.74-3.51-8.25-8.25-8.25zm3.74 11.6c-.2.57-1.15 1.1-1.58 1.14-.42.04-.95.07-1.51-.11-.35-.11-.79-.28-1.36-.55a9.03 9.03 0 0 1-2.8-2.23 4.91 4.91 0 0 1-.96-1.67c-.09-.29-.1-.53-.1-.72 0-.19.03-.42.05-.55.08-.43.35-.66.49-.75.12-.08.3-.12.47-.12.12 0 .24.01.35.01.11 0 .26-.03.4.31.15.37.52 1.27.57 1.36.04.09.07.21.01.34-.05.13-.08.21-.16.32-.08.11-.17.24-.25.32-.08.08-.17.17-.08.34.09.18.42.7.89 1.13.61.55 1.13.74 1.32.82.2.08.31.07.42-.04.11-.1.48-.55.61-.73.13-.18.26-.15.44-.09.19.06 1.19.56 1.39.66.2.1.33.15.38.23.05.07.05.4-.14.97z" />
            </svg>
        </a>


    {{-- Footer --}}
    <footer id="page-footer">
        @include('layouts.footer')
    </footer>

    <script>
        const waButton = document.getElementById('wa-button');
        const footer = document.getElementById('page-footer');

        window.addEventListener('scroll', () => {
            const footerTop = footer.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (footerTop < windowHeight - 20) {
                waButton.style.bottom = `${(windowHeight - footerTop) + 20}px`;
            } else {
                waButton.style.bottom = '20px';
            }
        });

        $(document).ready(function () {
            $('#bookmark-button').click(function () {
                const button = $(this);
                const lowonganId = button.data('lowongan-id');
                const isBookmarked = button.data('bookmarked') === true || button.data('bookmarked') === 'true';

                const method = isBookmarked ? 'DELETE' : 'POST';
                const url = '/bookmarks/' + lowonganId;

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Toggle text & data-bookmarked
                            if (isBookmarked) {
                                button.text('Save to Bookmark').data('bookmarked', false);
                            } else {
                                button.text('Bookmark Saved').data('bookmarked', true);
                            }
                            alert(response.message);
                        } else {
                            alert(response.message || 'Terjadi kesalahan.');
                        }
                    },
                    error: function(xhr) {
                        alert('Gagal mengupdate bookmark.');
                    }
                });
            });
        });
    </script>
</body>
</html>
