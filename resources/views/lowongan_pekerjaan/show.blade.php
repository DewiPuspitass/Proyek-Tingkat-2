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

                {{-- Flash Messages --}}
                @foreach (['success' => 'green', 'info' => 'blue', 'error' => 'red'] as $msg => $color)
                    @if(session($msg))
                        <div class="p-4 mb-4 text-sm text-{{ $color }}-800 bg-{{ $color }}-100 rounded-lg" role="alert">
                            {{ session($msg) }}
                        </div>
                    @endif
                @endforeach

                {{-- Header: Logo, Info, Tombol --}}
                <div class="flex justify-between items-start gap-6 flex-wrap">

                    {{-- Kiri: Logo + Informasi --}}
                    <div class="flex items-start gap-6">
                        <img src="{{ asset('storage/' . $lowongan_pekerjaan->foto_loker) }}" class="w-24 h-24 object-contain" alt="Logo Perusahaan">
                        <div>
                            <h1 class="text-2xl font-bold">{{ $lowongan_pekerjaan->nama_pekerjaan }}</h1>
                            <p class="text-lg text-gray-600">{{ $lowongan_pekerjaan->nama_perusahaan }}</p>
                            <div class="text-sm text-gray-500 space-y-1 mt-2">
                                <p>Lokasi: {{ $lowongan_pekerjaan->domisiliPerusahaan->name }}</p>
                                <p>Penempatan: {{ $lowongan_pekerjaan->domisiliPenempatan->name }}</p>
                                <p>Gaji: Rp{{ number_format($lowongan_pekerjaan->gaji, 0, ',', '.') }}</p>
                                <p>Diposting: {{ \Carbon\Carbon::parse($lowongan_pekerjaan->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: Tombol --}}
                    <!-- Tombol Lamar & Bookmark -->
                    @hasrole('siswa')
                        <div class="flex items-center gap-2 mt-6">
                        <a href="{{ $lowongan_pekerjaan->link_submit }}" target="_blank" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 text-center">
                            Lamar
                        </a>

                                <button
                                    class="px-4 py-2 border border-yellow-400 text-yellow-500 rounded-lg hover:bg-yellow-100"
                                    id="bookmark-button"
                                    data-lowongan-id="{{ $lowongan_pekerjaan->id }}"
                                    data-bookmarked="{{ auth()->check() && auth()->user()->bookmarks->contains($lowongan_pekerjaan->id) ? 'true' : 'false' }}">
                                    {{ auth()->check() && auth()->user()->bookmarks->contains($lowongan_pekerjaan->id) ? 'Bookmark Saved' : 'Save to Bookmark' }}
                                </button>
                        </div>
                    @endhasrole

                </div>

                {{-- Tipe Lowongan --}}
                @if ($lowongan_pekerjaan->tipeLoker->isNotEmpty())
                    <div>
                        <p class="text-lg font-semibold">Tipe Pekerjaan:</p>
                        <ul class="list-disc list-inside text-gray-700 text-base">
                            @foreach ($lowongan_pekerjaan->tipeLoker as $tipe)
                                <li>{{ $tipe->nama_tipe_lowongan }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Jurusan --}}
                @if ($lowongan_pekerjaan->jurusan->isNotEmpty())
                    <div>
                        <p class="text-lg font-semibold">Jurusan yang diterima:</p>
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
                    <p class="text-base text-gray-700 whitespace-pre-line">{{ $lowongan_pekerjaan->deskripsi }}</p>
                </div>

                {{-- Kualifikasi --}}
                <div>
                    <h3 class="text-lg font-semibold">Kualifikasi</h3>
                    <p class="text-base text-gray-700 whitespace-pre-line">{{ $lowongan_pekerjaan->kualifikasi }}</p>
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

                {{-- Link Submit & Batas Submit --}}
                <div class="space-y-1">
                    <p class="text-sm">
                        Link Pengumpulan:
                        <a href="{{ $lowongan_pekerjaan->link_submit }}" class="text-blue-500 underline">
                            {{ $lowongan_pekerjaan->link_submit }}
                        </a>
                    </p>
                    <p class="text-sm text-gray-600">
                        Batas submit: {{ \Carbon\Carbon::parse($lowongan_pekerjaan->batas_submit)->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>
        </div>
    </main>

    {{-- WhatsApp Floating Button --}}
    <a id="wa-button" href="https://wa.link/dbsvo5" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 32 32">
            <path d="M16 0c-8.837 0-16 7.163-16 16 0 2.837.74 5.567 2.139 7.991l-2.139 8.009 8.211-2.158c2.341 1.288 4.986 1.963 7.789 1.963 8.837 0 16-7.163 16-16s-7.163-16-16-16zM16 29.333c-2.341 0-4.628-.629-6.622-1.818l-.473-.283-4.889 1.286 1.303-4.822-.308-.495c-1.283-2.059-1.962-4.431-1.962-6.838 0-7.363 5.971-13.333 13.333-13.333s13.333 5.971 13.333 13.333c0 7.363-5.971 13.333-13.333 13.333zM23.448 19.536c-.362-.181-2.145-1.058-2.477-1.181-.333-.122-.576-.181-.818.181-.243.362-.941 1.181-1.152 1.423-.211.243-.423.272-.785.091-.362-.181-1.528-.562-2.909-1.792-1.076-.962-1.802-2.151-2.013-2.513-.211-.362-.022-.558.159-.739.163-.162.362-.423.543-.635.181-.211.241-.362.362-.604.122-.243.061-.454-.03-.635-.091-.181-.818-1.971-1.121-2.705-.294-.709-.593-.613-.818-.623l-.695-.012c-.243 0-.635.091-.967.454-.333.362-1.271 1.24-1.271 3.019s1.301 3.5 1.484 3.741c.181.243 2.541 3.885 6.162 5.451.862.372 1.534.594 2.058.762.865.276 1.652.237 2.276.144.694-.103 2.145-.876 2.448-1.723.302-.848.302-1.576.211-1.723-.091-.145-.333-.231-.695-.402z" />
        </svg>
    </a>


    {{-- Footer --}}
    <footer id="page-footer">
        @include('layouts.footer')
    </footer>

    {{-- Script Floating Button & Bookmark --}}
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
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status === 'success') {
                            if (isBookmarked) {
                                button.text('Simpan Lowongan').data('bookmarked', false);
                            } else {
                                button.text('Lowongan Disimpan').data('bookmarked', true);
                            }
                            alert(response.message);
                        } else {
                            alert(response.message || 'Terjadi kesalahan.');
                        }
                    },
                    error: function() {
                        alert('Gagal mengupdate bookmark.');
                    }
                });
            });
        });
    </script>

</body>
</html>
