<!DOCTYPE html>
<html>
  <body style="margin:0; padding:0; font-family:Arial, sans-serif; text-align: justify; text-justify: inter-word;">
    <p><b>REVISI INFORMASI LOWONGAN PEKERJAAN</b></p>
    <p>Hallo <b>{{ $name }}</b>,</p>
    <p>Kami ingin memberitahukan <b>revisi terkait lowongan pekerjaan</b> bahwa saat ini telah dibuka lowongan kerja baru di <b>{{ $nama_perusahaan }}</b>! Ini adalah kesempatan emas untuk kamu yang sedang mencari tantangan baru dan ingin berkembang.</p>
    <p>Posisi yang tersedia: </p>
    <ul>
      <li><b>{{ $nama_pekerjaan }}</b></li>
    </ul> 
    <p>
      Perusahaan ini berdomisili di 
      <span style="text-transform: capitalize;">
          <b>{{ \Illuminate\Support\Str::lower($domisili_penempatan) }}</b>
      </span>
    </p>
    <p>Silakan cek informasi selengkapnya dan kirimkan lamaranmu melalui <a href="{{ $link }}"><b>{{ $link }}</b></a> paling lambat <b>{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</b>.</p>
    <p>Jangan lewatkan kesempatan ini!</p>
    <p>Salam, </p>
    <p>BKK SMKN 2 Cimahi / Dede Sunandar</p>
  </body>
</html>
