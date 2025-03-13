<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja</title>
</head>
<body style="margin-left: 2em;">
    <h1>Lowongan Kerja</h1>
    @if (session()->has('success'))
        <span style="color: green;">{{ session('success') }}</span>
    @endif
    <a href="{{ Route('lowongan_pekerjaan.create') }}">Tambah Lowongan Kerja</a>
    
    <table style="margin-top: 1em;" border="1">
        <head>
            <tr>
                <th>Nama Pekerjaan</th>
                <th>Nama Perusahaan</th>
                <th>Domisili Penempatan</th>
                <th>Tanggal Post</th>
                <th>Action</th>
            </tr>
        </head>
        <body>
            @if (!empty($lowongan_kerja))
                @foreach ($lowongan_kerja as $l)
                    <tr>
                        <td>{{ $l->nama_pekerjaan }}</td>
                        <td>{{ $l->nama_perusahaan }}</td> 
                        <td>{{ $l->domisiliPenempatan->name ?? 'Tidak ada data' }}</td>
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
                    @endforeach
                    </tr>
                @else
                    <tr>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                    </tr>
                @endif
        </body>
    </table>
</body>
</html>