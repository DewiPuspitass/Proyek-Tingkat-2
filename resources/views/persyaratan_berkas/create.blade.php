<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Persyaratan Berkas</title>
</head>
<body style="margin:2em 0 0 2em;">
    <form action="{{ Route('persyaratan_berkas.store') }}" method="POST">
        @csrf
        <label for="">Nama Berkas</label>
        <input type="text" name="nama_berkas">

        <button type="submit">Tambah Persyaratan Berkas</button>
    </form>
</body>
</html>