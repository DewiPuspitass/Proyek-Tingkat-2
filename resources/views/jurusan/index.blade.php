<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/delet_alert.js') }}"></script>
    <title>Jurusan</title>
</head>
<body style="margin-left: 2em;">
    <h1>Ini Jurusan</h1>
    {{-- @if (session()->has('success'))
        <span style="color: green;">{{ session('success') }}</span>
    @endif --}}
    <a href="{{ route('jurusan.create') }}">Tambah Jurusan</a>
    <table style="margin-top: 1em;" border="1">
        <head>
            <tr>
                <th>Id</th>
                <th>Nama Jurusan</th>
                <th>Action</th>
            </tr>
        </head>
        <body>
            @if (!empty($jurusan))
                @foreach ($jurusan as $j)
                    <tr>
                        <td>{{ $j->id }}</td>
                        <td>{{ $j->nama_jurusan }}</td>
                        <td>
                            <a href="{{ route('jurusan.edit', $j->id) }}">Edit</a>
                            <form action="{{ route('jurusan.destroy', $j->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="confirmDelete(event, {{ $j->id }},'')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>Tidak tersedia</td>
                    <td>Tidak tersedia</td>
                </tr>
            @endif

        </body>
    </table>
</body>
</html>
