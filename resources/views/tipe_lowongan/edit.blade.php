<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/alert_succes_t.js') }}"></script>
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
        <button type="submit" id="simpan">Edit Tipe Lowongan</button>
    </form>

</body>
</html>
