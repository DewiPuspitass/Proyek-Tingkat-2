<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Lowongan Pekerjaan</title>
</head>
<body>
    <h1>Ini show lowongan</h1>
    <p>Nama Pekerjaan: {{ $lowongan_pekerjaan->nama_pekerjaan }}</p>
    <p>Nama Perusahaan: {{ $lowongan_pekerjaan->nama_perusahaan }}</p>
    <p>Domisili Perusahaan: {{ $lowongan_pekerjaan->domisiliPerusahaan->name }}</p>
    <p>Domisili Penempatan: {{ $lowongan_pekerjaan->domisiliPenempatan->name }}</p>
    @if ($lowongan_pekerjaan->jurusan->isNotEmpty())
        <li>Jurusan yang diterima:
            @foreach ($lowongan_pekerjaan->jurusan as $jurusan)
                {{ $jurusan->nama_jurusan }}
                @endforeach
        </li>
    @endif
    @if ($lowongan_pekerjaan->tipeLoker->isNotEmpty())
        <li>Tipe Loker: 
            @foreach ($lowongan_pekerjaan->tipeLoker as $tipeLoker)
                    {{ $tipeLoker->nama_tipe_lowongan }}
             @endforeach
        </li>

    @endif
    <p>Gaji: {{ $lowongan_pekerjaan->gaji }}</p>
    <p>Tanggal Post: {{ \Carbon\Carbon::parse($lowongan_pekerjaan->tanggal_post)->translatedFormat('d F Y') }}</p>
    <p>Deskripsi: {{ $lowongan_pekerjaan->deskripsi }}</p>
    <p>Kualifikasi: {{ $lowongan_pekerjaan->kualifikasi }}</p>
    <p>Persyaratan: {{ $lowongan_pekerjaan->persyaratan }}</p>
    <img src="{{ asset('storage/' . $lowongan_pekerjaan->foto_loker) }}" style="width: 200px; height:200px;" alt="Foto Loker">
    @if ($lowongan_pekerjaan->tipePersyaratan->isNotEmpty())
        <li>Berkas Persyaratan: 
            @foreach ($lowongan_pekerjaan->tipePersyaratan as $tipePersyaratan)
                {{ $tipePersyaratan->nama_berkas }}
            @endforeach
        </li>
    @endif
    <p>Link submit: <a href=" {{ $lowongan_pekerjaan->persyaratan }}"> {{ $lowongan_pekerjaan->persyaratan }}</a></p>
    <p>Batas Submit: {{ \Carbon\Carbon::parse($lowongan_pekerjaan->batas_submit)->translatedFormat('d F Y') }}</p>
</body>
</html>