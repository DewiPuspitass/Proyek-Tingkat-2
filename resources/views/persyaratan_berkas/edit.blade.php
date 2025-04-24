<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/alert_succes_p.js') }}"></script>
</head>
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
        <button type="submit" id="simpan">Edit Persyaratan Berkas</button>
    </form>

</body>
</html>
