<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/filterJurusan.js') }}"></script>


</head>

<body style="margin-left: 2em;">
    <h1>Lowongan Kerja</h1>
    @if (session()->has('success'))
        <span style="color: green;">{{ session('success') }}</span>
    @endif
    <a href="{{ Route('lowongan_pekerjaan.create') }}">Tambah Lowongan Kerja</a>

    <!-- Dropdown menu -->
    <button id="dropdownCheckboxButton" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mt-4">
        Filter Jurusan
        <svg class="w-2.5 h-2.5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdownJurusan" class="hidden absolute mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-50 p-3">
        <ul id="jurusanList" class="space-y-2 text-sm text-gray-700"></ul>
    </div>

    <table id="lowonganTable" border="1">
        <thead>
            <tr>
                <th>Nama Pekerjaan</th>
                <th>Nama Perusahaan</th>
                <th>Domisili Penempatan</th>
                <th>Deskripsi</th>
                <th>Tanggal Post</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($lowongan_kerja))
            @foreach ($lowongan_kerja as $l)
            <tr>
                <td>{{ $l->nama_pekerjaan }}</td>
                <td>{{ $l->nama_perusahaan }}</td>
                <td>{{ $l->domisili_penempatan ?? 'Tidak ada data' }}</td>
                <td>{{ $l->deskripsi ?? 'Tidak ada data' }}</td>
                <td>{{ $l->tanggal_post }}</td>
                <td>
                    <a href="{{ route('lowongan_pekerjaan.show', $l->id) }}">Info</a>
                    <a href="{{ route('lowongan_pekerjaan.edit', $l->id) }}">Edit</a>
                    <form action="{{ route('lowongan_pekerjaan.destroy', $l->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah anda ingin menghapus Lowongan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
                    </tr>
                @else
                    <tr>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                    </tr>
                @endif
        </tbody>
    </table>


</body>
</html>

