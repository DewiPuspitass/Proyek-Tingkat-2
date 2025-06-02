<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Tersimpan</title>

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

    <main class="flex-grow max-w-7xl mx-auto px-4 min-h-[calc(100vh-6rem)]">
        {{-- Flash Message --}}
        @if (session()->has('success'))
            <span class="flex flex-wrap items-center gap-4 mb-6 justify-center text-green-600">{{ session('success') }}</span>
        @endif

        <h2 class="text-2xl font-semibold text-orange-600 mb-6 text-center">Daftar Lowongan yang Disimpan</h2>

        {{-- Daftar Bookmarks --}}
        <div id="job-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($bookmarks as $bookmark)
            @if($bookmark->user && $bookmark->lowongan_kerja)
            <div class="job-item relative flex items-center border rounded-lg p-4 shadow-sm bg-white"
                 data-deadline="{{ $bookmark->lowongan_kerja->batas_submit }}">

                {{-- Logo --}}
                <div class="w-16 h-16 flex-shrink-0 rounded-md overflow-hidden mr-4 bg-gray-100 flex items-center justify-center">
                    @if($bookmark->lowongan_kerja->foto_loker)
                        <img src="{{ asset('storage/' . $bookmark->lowongan_kerja->foto_loker) }}" alt="Logo" class="w-full h-full object-contain">
                    @else
                        <span class="text-gray-400 text-sm">Logo</span>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1">
                    <h3 class="text-base font-semibold text-gray-800">{{ $bookmark->lowongan_kerja->nama_pekerjaan ?? 'No Title' }}</h3>
                    <p class="text-sm text-gray-600">{{ $bookmark->lowongan_kerja->nama_perusahaan ?? 'No Company' }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $bookmark->lowongan_kerja->domisiliPenempatan->name ?? '-' }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        {{ \Carbon\Carbon::parse($bookmark->lowongan_kerja->created_at)->diffForHumans() }}
                    </p>

                    @php
                        $deadline = \Carbon\Carbon::parse($bookmark->lowongan_kerja->batas_submit);
                        $now = \Carbon\Carbon::today();
                        $akhir = $deadline->lt($now);
                    @endphp

                    @if ($akhir)
                        <p class="text-xs text-red-600 font-semibold mt-1">Lowongan telah ditutup</p>
                    @endif
                </div>

                {{-- Aksi --}}
                <div class="ml-4 flex flex-col gap-1 text-sm text-right">
                    <a href="{{ route('lowongan_pekerjaan.show', $bookmark->lowongan_kerja->id) }}" class="text-blue-600 hover:underline">Info</a>
                    <button onclick="hapusBookmark('{{ $bookmark->lowongan_kerja->id }}')" class="text-red-600 hover:underline">Hapus</button>
                </div>
            </div>
            @endif
        @empty
            <div class="col-span-full text-center text-gray-500 py-12">
                <p class="text-lg font-medium">Tidak ada Lowongan Pekerjaan yang Disimpan</p>
            </div>
        @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $bookmarks->links() }}
        </div>

    </main>

    @include('layouts.footer')

</body>
</html>

<script>
function hapusBookmark(lowonganId) {
    Swal.fire({
        title: 'Hapus Bookmark?',
        text: "Apakah kamu yakin ingin menghapus lowongan ini dari bookmark?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/bookmarks/${lowonganId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Berhasil!', response.message, 'success').then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus bookmark.', 'error');
                }
            });
        }
    });
}
</script>
