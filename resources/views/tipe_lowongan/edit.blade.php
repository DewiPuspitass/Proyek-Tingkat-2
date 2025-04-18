<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiper Lowongan Edit</title>
</head>
<body style="margin-left: 2em;">
    <h1>Tipe Lowongan Edit</h1>

    <a href="{{ route('tipe_lowongan.index') }}">Kembali</a>
    <form action="{{ route('tipe_lowongan.update', $tipe_lowongan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="">Nama Jurusan</label>
        <input type="text" name="nama_tipe_lowongan" value="{{ $tipe_lowongan->nama_tipe_lowongan }}">
        @if ($errors->has('nama_tipe_lowongan'))
            <span style="color: red;">{{ $errors->first('nama_tipe_lowongan') }}</span>
        @endif
        <button type="submit">Edit Tipe Lowongan</button>
    </form>

</body>
</html>
