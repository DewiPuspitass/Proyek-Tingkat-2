@forelse ($lowongan_pekerjaan as $l)
    <tr>
        <td>{{ $l->nama_pekerjaan }}</td>
        <td>{{ $l->nama_perusahaan }}</td>
        <td>{{ $l->domisiliPenempatan->name ?? 'Tidak ada data' }}</td>
        <td>{{ $l->tanggal_post }}</td>
        <td>
            <a href="{{ route('lowongan_pekerjaan.show', $l->id) }}">Info</a>
            <a href="{{ route('lowongan_pekerjaan.edit', $l->id) }}">Edit</a>
            <form action="{{ route('lowongan_pekerjaan.destroy', $l->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Apakah anda ingin menghapus Lowongan ini?')">Hapus</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" style="text-align: center;">Tidak ada data</td>
    </tr>
@endforelse
