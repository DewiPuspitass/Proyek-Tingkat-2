<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan Create</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/alet_succes.js') }}"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Tambah Jurusan</h1>

        <a href="{{ route('jurusan.index') }}" class="text-blue-500 hover:underline text-sm mb-4 inline-block">
            &larr; Kembali
        </a>

        <form action="{{ route('jurusan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nama_jurusan" class="block text-gray-700 font-medium mb-1">Nama Jurusan</label>
                <input
                    type="text"
                    name="nama_jurusan"
                    id="nama_jurusan"
                    value="{{ old('nama_jurusan') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                @if ($errors->has('nama_jurusan'))
                    <p class="text-red-600 text-sm mt-1">{{ $errors->first('nama_jurusan') }}</p>
                @endif
            </div>

            <div class="text-right">
                <button
                    type="submit"
                    id="simpan"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Tambahkan Jurusan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
