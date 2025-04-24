<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Persyaratan Berkas</title>
    <title>Jurusan Create</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/alert_succes_p.js') }}"></script>
</head>
<body style="margin:2em 0 0 2em;">
    <form action="{{ Route('persyaratan_berkas.store') }}" method="POST">
        @csrf
        <label for="">Nama Berkas</label>
        <input type="text" name="nama_berkas" value="{{ old('nama_berkas')}}">
        @if ($errors->has('nama_berkas'))
        <span style="color: red;">{{ $errors->first('nama_berkas') }}</span>
        @endif
        <button type="submit" id="simpan">Tambah Persyaratan Berkas</button>
    </form>
</body>
</html>
