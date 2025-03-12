<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan Create</title>
</head>
<body style="margin-left: 2em;">
    <h1>Jurusan Create</h1>
    <a href="{{ route('jurusan.index') }}">Kembali</a>
    <form action="{{ route('jurusan.store') }}" method="POST">
        @csrf
        <label for="">Nama Jurusan</label>
        <input type="text" name="nama_jurusan" required>
        @if ($errors->has('nama_jurusan'))
            <span style="color: red;">{{ $errors->first('nama_jurusan') }}</span>
        @endif
        <button type="submit">Tambahkan jurusan</button>
    </form>
</body>
</html>