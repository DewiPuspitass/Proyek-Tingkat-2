<!DOCTYPE html>
<html>
  <body style="margin:0; padding:0; font-family:Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;">
      <tr>
        <td align="center" style="padding:20px 0; background-color:#333; ">
          <a href="#" style="color:#fff; text-decoration:none; margin:0 15px;">foto smk</a>
        </td>
      </tr>
      <tr>
        <td align="center" style="padding:40px;">
          <h1 style="color:#333;">Hallo, {{ $name }}! Ada info pekerjaan sebagai <b>{{ $nama_pekerjaan }}</b>, nih buat kamu!</h1>
          <p style="color:#555;">Ayo lihat info dibawah ini.</p>
        </td>
      </tr>
      <tr>
        <table>
            <tr>
                <td><img src="" alt=""></td>
                <td>Backend</td>
            </tr>
            <tr>
                <td></td>
                <td>{{ $domisili_penempatan }} || {{ $nama_perusahaan }} || {{ $tipe_lowongan }}</td>
            </tr>
        </table>
      </tr>
      <a href="">Ayo lihat lokernya sekarang!</a>
    </table>
  </body>
</html>
