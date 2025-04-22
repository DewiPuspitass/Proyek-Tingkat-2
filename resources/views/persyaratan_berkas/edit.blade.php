<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persyaratan Berkas Edit</title>
</head>
<body style="margin-left: 2em;">
    <h1>Persyaratan Berkas Edit</h1>

    <a href="{{ route('persyaratan_berkas.index') }}">Kembali</a>
    <form action="{{ route('persyaratan_berkas.update', $persyaratan_berkas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="">Nama Jurusan</label>
        <input type="text" name="nama_berkas" value="{{ $persyaratan_berkas->nama_berkas }}">
        @if ($errors->has('nama_berkas'))
            <span style="color: red;">{{ $errors->first('nama_berkas') }}</span>
        @endif
        <button type="submit">Edit Persyaratan Berkas</button>
    </form>

</body>
</html>
