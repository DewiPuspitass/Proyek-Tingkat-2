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
</head>

<body class="pt-24 bg-white min-h-screen flex flex-col">
    @include('layouts.navigation')

    <main class="max-w-4xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-black mb-8">Masukkan Informasi Lowongan Pekerjaan</h2>
        <form action="{{ route('lowongan_pekerjaan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Pekerjaan -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Pekerjaan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_pekerjaan" value="{{ old('nama_pekerjaan') }}"
                    class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('nama_pekerjaan')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Nama Perusahaan -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                    class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('nama_perusahaan')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Domisili Penempatan dan Domisili Perusahaan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Domisili Penempatan -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Domisili Penempatan <span class="text-red-500">*</span></label>
        <select name="domisili_penempatan" class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">-- Pilih --</option>
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}" {{ old('domisili_penempatan') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
            @endforeach
        </select>
        @error('domisili_penempatan')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    <!-- Domisili Perusahaan -->
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Domisili Perusahaan <span class="text-red-500">*</span></label>
        <select name="domisili_perusahaan" class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">-- Pilih --</option>
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}" {{ old('domisili_perusahaan') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
            @endforeach
        </select>
        @error('domisili_perusahaan')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
</div>


            <!-- Jurusan -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Jurusan <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach ($jurusan as $j)
                        <div class="flex items-center">
                            <input type="checkbox" name="jurusan[]" id="jurusan_{{ $j->id }}" value="{{ $j->id }}"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-black rounded"
                                {{ is_array(old('jurusan')) && in_array($j->id, old('jurusan')) ? 'checked' : '' }}>
                            <label for="jurusan_{{ $j->id }}" class="ml-2 block text-sm text-gray-700">
                                {{ $j->nama_jurusan }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('jurusan')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Tipe Loker -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Loker <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach ($tipe_lowongan as $t)
                        <div class="flex items-center">
                            <input type="checkbox" name="tipe_lowongan[]" id="tipe_{{ $t->id }}" value="{{ $t->id }}"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-black rounded"
                                {{ is_array(old('tipe_lowongan')) && in_array($t->id, old('tipe_lowongan')) ? 'checked' : '' }}>
                            <label for="tipe_{{ $t->id }}" class="ml-2 block text-sm text-gray-700">
                                {{ $t->nama_tipe_lowongan }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('tipe_lowongan')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Gaji -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Gaji <span class="text-red-500">*</span></label>
                <input type="text" name="gaji" value="{{ old('gaji') }}"
                    class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('gaji')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi"
                    class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Kualifikasi -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kualifikasi <span class="text-red-500">*</span></label>
                <textarea name="kualifikasi"
                    class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32">{{ old('kualifikasi') }}</textarea>
                @error('kualifikasi')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Foto Loker -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Foto Lembaran Lowongan <span class="text-red-500">*</span></label>
                <input type="file" name="foto_loker"
                    class="w-full px-3 py-2 border border-black rounded shadow text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('foto_loker')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Persyaratan Berkas -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Persyaratan Berkas <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach ($persyaratan_berkas as $pb)
                        <div class="flex items-center">
                            <input type="checkbox" name="persyaratan_berkas[]" id="berkas_{{ $pb->id }}" value="{{ $pb->id }}"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-black rounded"
                                {{ is_array(old('persyaratan_berkas')) && in_array($pb->id, old('persyaratan_berkas')) ? 'checked' : '' }}>
                            <label for="berkas_{{ $pb->id }}" class="ml-2 block text-sm text-gray-700">
                                {{ $pb->nama_berkas }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('persyaratan_berkas')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Link & Batas Submit -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Link Submit <span class="text-red-500">*</span></label>
                    <input type="text" name="link_submit"
                        class="w-full border border-black rounded px-3 py-2">
                    @error('link_submit')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block font-semibold mb-1">Batas Submit <span class="text-red-500">*</span></label>
                    <input type="date" name="batas_submit" value="{{ old('batas_submit') }}"
                        class="w-full border border-black rounded px-3 py-2 leading-tight focus:outline-none focus:shadow-outline"
                        min="{{ date('Y-m-d') }}">
                    @error('batas_submit')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" id="simpan" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Simpan Lowongan Kerja
                </button>
            </div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new TomSelect('select[name="domisili_penempatan"]');
                new TomSelect('select[name="domisili_perusahaan"]');
            });
        </script>
    </main>

    @include('layouts.footer')
</body>
</html>
