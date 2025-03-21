<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/delet_alert.js') }}"></script>
    <title>Tipe Lowongan</title>
</head>
<body style="margin-left: 2em;">
    <h1>Tipe Lowongan</h1>
    <a href="{{ route('tipe_lowongan.create' )}}">Tambah Tipe Lowongan</a>
    <table>
        <head>
            <tr>
                <th>No</th>
                <th>Nama Tipe</th>
            </tr>
        </head>
        <body>
            @if (!empty($tipe_lowongan))
                @foreach ($tipe_lowongan as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->nama_tipe_lowongan }}</td>
                        <td>
                            <a href="{{ route('tipe_lowongan.edit', $t->id) }}">Edit</a>
                            <form action="{{ route('tipe_lowongan.destroy', $t->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="confirmDelete(event, {{ $t->id }})">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                </tr>
            @endif
        </body>
    </table>
</body>



</html>

