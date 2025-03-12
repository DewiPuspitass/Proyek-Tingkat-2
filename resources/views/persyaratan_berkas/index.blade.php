<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peryaratan Berkas</title>
</head>
<body style="margin-left: 2em;">
    <h1>Persyaratan Berkas</h1>
    @if (session()->has('success'))
        <span style="color: green;">{{ session('success') }}</span>
    @endif
    <a href="{{ route('persyaratan_berkas.create')}}">Tambah Persyaratan</a>

    <table style="margin-top: 1em;" border="1">
        <head>
            <tr>
                <th>Id</th>
                <th>Nama Berkas</th>
                <th>Action</th>
            </tr>
        </head>
        <body>
            @if (!empty($persyaratan_berkas))
                @foreach ($persyaratan_berkas as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->nama_berkas }}</td>
                        <td>
                            <a href="{{ route('persyaratan_berkas.edit', $p->id) }}">Edit</a>
                            <form action="{{ route('persyaratan_berkas.destroy', $p->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah anda ingin menghapus persyaratan berkas ini?')">Hapus</button>
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