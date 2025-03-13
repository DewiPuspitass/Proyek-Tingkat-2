<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lowongan Kerja</title>
</head>
<body style="margin-left: 2em;">
    <h1>Edit Lowongan Kerja</h1>
    <form action="{{ route('lowongan_pekerjaan.update', $lowongan_pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama Pekerjaan</label>
        <input type="text" name="nama_pekerjaan" value="{{ old('nama_pekerjaan', $lowongan_pekerjaan->nama_pekerjaan) }}" required><br>

        <label>Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $lowongan_pekerjaan->nama_perusahaan) }}" required><br>

        <label>Domisili Penempatan</label><br>
        <select name="domisili_penempatan">
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}" {{ old('domisili_penempatan', $lowongan_pekerjaan->domisili_penempatan) == $r->id ? 'selected' : '' }}>
                    {{ $r->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Domisili Perusahaan</label><br>
        <select name="domisili_perusahaan">
            @foreach ($regensi as $r)
                <option value="{{ $r->id }}" {{ old('domisili_perusahaan', $lowongan_pekerjaan->domisili_perusahaan) == $r->id ? 'selected' : '' }}>
                    {{ $r->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Jurusan</label><br>
        @foreach ($jurusan as $j)
            <input type="checkbox" name="jurusan[]" value="{{ $j->id }}" 
                {{ in_array($j->id, old('jurusan', $lowongan_pekerjaan->jurusan->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $j->nama_jurusan }}<br>
        @endforeach
        <br>

        <label>Tipe Loker</label><br>
        @foreach ($tipe_lowongan as $t)
            <input type="checkbox" name="tipe_lowongan[]" value="{{ $t->id }}" 
                {{ in_array($t->id, old('tipe_lowongan', $lowongan_pekerjaan->tipeLoker->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $t->nama_tipe_lowongan }}<br>
        @endforeach
        <br>

        <label>Gaji</label>
        <input type="number" name="gaji" value="{{ old('gaji', $lowongan_pekerjaan->gaji) }}"><br>

        <label>Deskripsi</label>
        <textarea name="deskripsi">{{ old('deskripsi', $lowongan_pekerjaan->deskripsi) }}</textarea><br>

        <label>Kualifikasi</label>
        <textarea name="kualifikasi">{{ old('kualifikasi', $lowongan_pekerjaan->kualifikasi) }}</textarea><br>

        <label>Persyaratan</label>
        <textarea name="persyaratan">{{ old('persyaratan', $lowongan_pekerjaan->persyaratan) }}</textarea><br><br>

        <label>Foto Lembaran lowongan</label>
        <input type="file" name="foto_loker"><br><br>
        @if (!empty($lowongan_pekerjaan->foto_loker))
            <img src="{{ asset('storage/' . $lowongan_pekerjaan->foto_loker) }}" style="width: 200px; height:200px;" alt="Foto Loker">
        @endif

        <label>Persyaratan Berkas</label><br>
        @foreach ($persyaratan_berkas as $pb)
            <input type="checkbox" name="persyaratan_berkas[]" value="{{ $pb->id }}" 
                {{ in_array($pb->id, old('persyaratan_berkas', $lowongan_pekerjaan->tipePersyaratan->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $pb->nama_berkas }}<br>
        @endforeach
        <br><br>

        <label>Link Submit</label>
        <input type="text" name="link_submit" value="{{ old('link_submit', $lowongan_pekerjaan->link_submit) }}"><br> 

        <label>Batas Submit</label>
        <input type="date" name="batas_submit" value="{{ old('batas_submit', $lowongan_pekerjaan->batas_submit) }}"><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
