<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Lowongan</title>
</head>
<body style="margin-left: 2em;">
    <h1>Tipe Lowongan</h1>
    <form action="{{ route('tipe_lowongan.store') }}" method="POST">
        @csrf
        <label for="">Nama Tipe Lowongan</label>
        <input type="text" name="nama_tipe_lowongan" required>
        <button type="submit">Tambah Tipe Lowongan</button>
    </form>
</body>
</html>