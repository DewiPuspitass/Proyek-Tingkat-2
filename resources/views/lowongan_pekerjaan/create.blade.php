<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">


    <script type="text/javascript" src="{{ asset('js/alert_create.js') }}"></script>


    <title>Lowongan Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="pt-24 bg-white min-h-screen flex flex-col">
    {{-- Navigation --}}
    @include('layouts.navigation')

    
    <main class="max-w-4xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-black mb-8">Masukkan Informasi Lowongan Pekerjaan</h2>
        <form action="{{ route('lowongan_pekerjaan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

          <!-- Nama Pekerjaan -->
<div>
    <label class="block font-semibold mb-1">Nama Pekerjaan</label>
    <input type="text" name="nama_pekerjaan" required class="w-full border border-slate-950 rounded px-3 py-2">
</div>

<!-- Nama Perusahaan -->
<div>
    <label class="block font-semibold mb-1">Nama Perusahaan</label>
    <input type="text" name="nama_perusahaan" required class="w-full border border-slate-950 rounded px-3 py-2">
</div>

<!-- Domisili Penempatan & Domisili Perusahaan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1">Domisili Penempatan</label>
        <select name="domisili_penempatan" class="w-full border border-slate-950 rounded px-3 py-2">
            <option value="">-- Pilih --</option>
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block font-semibold mb-1">Domisili Perusahaan</label>
        <select name="domisili_perusahaan" class="w-full border border-slate-950 rounded px-3 py-2">
            <option value="">-- Pilih --</option>
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- Gaji -->
<div>
    <label class="block font-semibold mb-1">Gaji</label>
    <input type="number" name="gaji" class="w-full border border-slate-950 rounded px-3 py-2">
</div>

<!-- Deskripsi, Kualifikasi, Persyaratan -->
<div>
    <label class="block font-semibold mb-1">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="w-full border border-slate-950 rounded px-3 py-2"></textarea>
</div>

<div>
    <label class="block font-semibold mb-1">Kualifikasi</label>
    <textarea name="kualifikasi" rows="4" class="w-full border border-slate-950 rounded px-3 py-2"></textarea>
</div>

<!-- Foto Loker -->
<div>
    <label class="block font-semibold mb-1">Foto Lembaran Lowongan</label>
    <!-- Tombol Pilih File -->
    <label for="foto_loker" class="inline-block bg-orange-500 text-white px-6 py-2 rounded cursor-pointer text-center">
        Pilih File
    </label>
    <input type="file" id="foto_loker" name="foto_loker" class="hidden" onchange="displayFileName()">
    <!-- Nama File yang Dipilih -->
    <span id="fileName" class="block mt-2 text-sm text-gray-600"></span>
</div>

<script>
    // Fungsi untuk menampilkan nama file yang dipilih
    function displayFileName() {
        const fileInput = document.getElementById('foto_loker');
        const fileName = document.getElementById('fileName');
        if (fileInput.files.length > 0) {
            fileName.textContent = `File yang dipilih: ${fileInput.files[0].name}`;
        } else {
            fileName.textContent = '';
        }
    }
</script>

<!-- Persyaratan Berkas -->
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

<!-- Link & Batas Submit -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1">Link Submit</label>
        <input type="text" name="link_submit" class="w-full border border-slate-950 rounded px-3 py-2">
    </div>
    <div>
        <label class="block font-semibold mb-1">Batas Submit</label>
        <input 
            type="date" 
            name="batas_submit" 
            class="w-full border border-slate-950 rounded px-3 py-2"
            min="{{ date('Y-m-d') }}"
        >
    </div>
</div>

<!-- Submit -->
<div class="pt-4">
    <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-500">Unggah Lowongan Pekerjaan</button>
</div>

        </form>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect('select[name="domisili_penempatan"]');
            new TomSelect('select[name="domisili_perusahaan"]');
        });
    </script>
</body>
</html>