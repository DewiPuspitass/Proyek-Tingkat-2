<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/delet_alert.js') }}"></script>

@forelse ($lowongan_pekerjaan as $l)
    <tr>
        <td>{{ $l->nama_pekerjaan }}</td>
        <td>{{ $l->nama_perusahaan }}</td>
        <td>{{ $l->domisiliPenempatan->name ?? 'Tidak ada data' }}</td>
        <td>{{ $l->deskripsi }}</td>
        <td>{{ $l->tanggal_post }}</td>
        <td>
            <a href="{{ route('lowongan_pekerjaan.show', $l->id) }}">Info</a>
            <a href="{{ route('lowongan_pekerjaan.edit', $l->id) }}">Edit</a>
            <form id="delete-form-{{ $l->id }}" action="{{ route('lowongan_pekerjaan.destroy', $l->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="confirmDelete(event, {{ $l->id }})">Hapus</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" style="text-align: center;">Tidak ada data</td>
    </tr>
@endforelse
