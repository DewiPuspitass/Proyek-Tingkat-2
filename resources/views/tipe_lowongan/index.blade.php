<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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