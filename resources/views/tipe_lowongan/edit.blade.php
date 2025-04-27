<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tipe Lowongan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/alert_succes_t.js') }}"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <a href="{{ route('jurusan.index') }}" class="text-blue-600/100 px-4 py-1 rounded block mb-4 w-max flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <h1 class="text-2xl font-bold mb-4 text-gray-800 text-center">Edit Tipe Lowongan</h1>

        <form action="{{ route('tipe_lowongan.update', $tipe_lowongan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="nama_tipe_lowongan" class="block text-gray-700 font-medium mb-1">Nama Tipe Lowongan</label>
                <input
                    type="text"
                    name="nama_tipe_lowongan"
                    id="nama_tipe_lowongan"
                    value="{{ old('nama_tipe_lowongan', $tipe_lowongan->nama_tipe_lowongan) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                @if ($errors->has('nama_tipe_lowongan'))
                    <p class="text-red-600 text-sm mt-1">{{ $errors->first('nama_tipe_lowongan') }}</p>
                @endif
            </div>

            <div class="text-right">
                <button
                    type="submit"
                    id="simpan"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                >
                    Edit
                </button>
            </div>
        </form>
    </div>
</body>
</html>
