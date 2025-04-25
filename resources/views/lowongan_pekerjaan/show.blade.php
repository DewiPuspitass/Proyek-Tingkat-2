<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Lowongan Pekerjaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="pt-24 bg-white min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('layouts.navigation')

    <main>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow space-y-8">

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
                        <p>Diposting: {{ \Carbon\Carbon::parse($lowongan_pekerjaan->tanggal_post)->diffForHumans() }}</p>
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

            {{-- Persyaratan --}}
            <div>
                <h3 class="text-lg font-semibold">Persyaratan</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $lowongan_pekerjaan->persyaratan }}</p>
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
                <button class="px-4 py-2 border border-yellow-400 text-yellow-500 rounded-lg hover:bg-yellow-100">Markah</button>
            </div>

        </div>
    </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
</html>