<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="pt-24 bg-white min-h-screen flex flex-col">
    {{-- Navigation --}}
    @include('layouts.navigation')

    <main class="max-w-4xl mx-auto px-6 py-12">
        <form action="{{ route('lowongan_pekerjaan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Nama Pekerjaan --}}
            <div>
                <label class="block font-semibold mb-1">Nama Pekerjaan</label>
                <input type="text" name="nama_pekerjaan" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Nama Perusahaan --}}
            <div>
                <label class="block font-semibold mb-1">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" required class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Domisili Penempatan & Domisili Perusahaan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Domisili Penempatan</label>
                    <select name="domisili_penempatan" class="w-full border border-gray-300 rounded px-3 py-2">
                        @foreach ($regensi as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Domisili Perusahaan</label>
                    <select name="domisili_perusahaan" class="w-full border border-gray-300 rounded px-3 py-2">
                        @foreach ($regensi as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Jurusan --}}
            <div>
                <label class="block font-semibold mb-2">Jurusan</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($jurusan as $j)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="jurusan[]" value="{{ $j->id }}" class="rounded">
                            <span>{{ $j->nama_jurusan }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Tipe Lowongan --}}
            <div>
                <label class="block font-semibold mb-2">Tipe Loker</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($tipe_lowongan as $t)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="tipe_lowongan[]" value="{{ $t->id }}" class="rounded">
                            <span>{{ $t->nama_tipe_lowongan }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Gaji --}}
            <div>
                <label class="block font-semibold mb-1">Gaji</label>
                <input type="number" name="gaji" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Deskripsi, Kualifikasi, Persyaratan --}}
            <div>
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Kualifikasi</label>
                <textarea name="kualifikasi" rows="4" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Persyaratan</label>
                <textarea name="persyaratan" rows="4" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

            {{-- Foto Loker --}}
            <div>
                <label class="block font-semibold mb-1">Foto Lembaran Lowongan</label>
                <input type="file" name="foto_loker" class="w-full">
            </div>

            {{-- Persyaratan Berkas --}}
            <div>
                <label class="block font-semibold mb-2">Persyaratan Berkas</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($persyaratan_berkas as $pb)
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="persyaratan_berkas[]" value="{{ $pb->id }}" class="rounded">
                            <span>{{ $pb->nama_berkas }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Link & Batas Submit --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Link Submit</label>
                    <input type="text" name="link_submit" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Batas Submit</label>
                    <input type="date" name="batas_submit" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-4">
                <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-500">Unggah Lowongan Pekerjaan</button>
            </div>
        </form>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
</html>