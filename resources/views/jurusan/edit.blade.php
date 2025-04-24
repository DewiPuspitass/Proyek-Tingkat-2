<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan Create</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/alet_succes.js') }}"></script>
    <title>Jurusan Edit</title>
</head>
<body style="margin-left: 2em;">
    <h1>Jurusan Edit</h1>

    <a href="{{ route('jurusan.index') }}">Kembali</a>
    <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="">Nama Jurusan</label>
        <input type="text" name="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" required>
        @if ($errors->has('nama_jurusan'))
            <span style="color: red;">{{ $errors->first('nama_jurusan') }}</span>
        @endif
        <button type="submit"  id="simpan">Edit jurusan</button>
    </form>
</body>
</html>
