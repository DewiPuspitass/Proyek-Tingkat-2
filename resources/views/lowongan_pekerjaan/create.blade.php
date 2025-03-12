<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja</title>
</head>
<body style="margin-left: 2em;">
    <h1>Tambah Lowongan Kerja</h1>
    <form action="{{ route('lowongan_pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="">Nama Pekerjaan</label>
        <input type="text" name="nama_pekerjaan" required><br>

        <label for="">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" required><br>

        <label for="">Domisili Penempatan</label><br>
        <select name="domisili_penempatan" id="">
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select><br><br>
        <label for="">Domisili Perusahaan</label><br>
        <select name="domisili_perusahaan" id="">
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select><br><br>

        <label for="">Jurusan</label><br>
        @foreach ($jurusan as $j)
        <input type="checkbox" name="jurusan[]" value="{{ $j->id }}">{{ $j->nama_jurusan }}<br>
        @endforeach
        <br>

        <label for="">Tipe Loker</label><br>
        @foreach ($tipe_lowongan as $t)
        <input type="checkbox" name="tipe_lowongan[]" value="{{ $t->id }}">{{ $t->nama_tipe_lowongan }}<br>
        @endforeach
        <br>

        <label for="">Gaji</label>
        <input type="" name="gaji"><br>

        <label for="">Deskripsi</label>
        <textarea name="deskripsi" id=""></textarea><br>

        <label for="">Kualifikasi</label>
        <textarea name="kualifikasi" id=""></textarea><br>

        <label for="">Persyaratan</label>
        <textarea name="persyaratan" id=""></textarea><br><br>

        <label for="">Foto Lembaran lowongan</label>
        <input type="file" name="foto_loker"><br><br>

        <label for="">Persyaratan Berkas</label><br>
        @foreach ($persyaratan_berkas as $pb)
        <input type="checkbox" name="persyaratan_berkas[]" value="{{ $pb->id }}">{{ $pb->nama_berkas }}<br>
        @endforeach
        <br><br>
    
        <label for="">Link Submit</label>
        <input type="text" name="link_submit"><br> 

        <label for="">Batas Submit</label>
        <input type="date" name="batas_submit"><br><br>

        <button type="submit">Simpan Lowongan Kerja</button>
    </form>
</body>
</html>