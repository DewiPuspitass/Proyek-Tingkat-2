<script src="{{ asset('js/delet_alert.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@forelse ($lowongan_pekerjaan as $l)
    <div class="job-item relative flex items-center border rounded-lg p-4 shadow-sm bg-white"
        data-deadline="{{ $l->batas_submit }}">

        {{-- Logo --}}
        <div class="w-16 h-16 flex-shrink-0 rounded-md overflow-hidden mr-4 bg-gray-100 flex items-center justify-center">
            @if ($l->foto_loker)
                <img src="{{ asset('storage/' . $l->foto_loker) }}" alt="Logo" class="w-full h-full object-contain">
            @else
                <span class="text-gray-400 text-sm">Logo</span>
            @endif
        </div>

        {{-- Info --}}
        <div class="flex-1">
            <h3 class="text-base font-semibold text-gray-800">{{ $l->nama_pekerjaan }}</h3>
            <p class="text-sm text-gray-600">{{ $l->nama_perusahaan }}</p>
            <p class="text-xs text-gray-500">{{ $l->domisiliPenempatan->name ?? '-' }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($l->created_at)->diffForHumans() }}</p>

            {{-- Tanggal + sisa waktu --}}
            <p class="text-xs text-gray-400 mt-1" id="sisa-waktu-{{ $l->id }}"
                data-deadline="{{ $l->batas_submit }}">
                Menghitung waktu...
            </p>

            {{-- Status --}}
            @hasrole('admin')
                <p class="text-xs font-semibold mt-1">
                    Status:
                    @if ($l->status === 'Aktif')
                        <span class="text-green-600">Aktif</span>
                        @php
                            $deadline = \Carbon\Carbon::parse($l->batas_submit);
                            $now = \Carbon\Carbon::today();
                        @endphp
                        @if ($deadline->lt($now))
                            <span class="text-yellow-600">(batas submit sudah lewat)</span>
                        @endif
                    @else
                        <span class="text-red-600">Nonaktif</span>
                    @endif
                </p>
            @endhasrole
        </div>

        {{-- Aksi --}}
        <div class="ml-4 flex flex-col items-end gap-1 text-sm">
            <a href="{{ route('lowongan_pekerjaan.show', $l->id) }}" class="text-blue-600 hover:underline">Info</a>
            @hasrole('admin')
                <a href="{{ route('lowongan_pekerjaan.edit', $l->id) }}" class="text-yellow-600 hover:underline">Edit</a>

                {{-- Tombol Hapus --}}
                <form action="{{ route('lowongan_pekerjaan.destroy', $l->id) }}" method="POST"
                    onsubmit="return confirm('Yakin mau hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline"
                        onclick="confirmDelete(event, '{{ $l->id }}')">Hapus</button>
                </form>
            @endhasrole
        </div>
    </div>
@empty
    <div class="col-span-full text-center text-gray-500">Tidak ada lowongan tersedia saat ini.</div>
@endforelse


<script>
    function formatTanggalIndonesia(dateObj) {
        const bulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        const tgl = dateObj.getDate();
        const bln = bulan[dateObj.getMonth()];
        const thn = dateObj.getFullYear();
        return `${tgl} ${bln} ${thn}`;
    }

    function hitungSisaWaktu(deadlineStr) {
        const now = new Date();
        const deadline = new Date(deadlineStr + 'T23:59:59');
        const selisihMs = deadline - now;

        if (selisihMs <= 0) return "Sudah lewat";

        const detik = Math.floor(selisihMs / 1000);
        const hari = Math.floor(detik / 86400);
        const jam = Math.floor((detik % 86400) / 3600);
        const menit = Math.floor((detik % 3600) / 60);

        if (hari > 0) return `${hari} hari lagi`;
        if (jam > 0) return `${jam} jam lagi`;
        if (menit > 0) return `${menit} menit lagi`;
        return `Kurang dari 1 menit lagi`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[id^="sisa-waktu-"]').forEach(el => {
            const deadline = el.dataset.deadline;
            const tanggalObj = new Date(deadline + 'T00:00:00');
            const tanggalTeks = formatTanggalIndonesia(tanggalObj);
            const sisa = hitungSisaWaktu(deadline);
            el.textContent = `${tanggalTeks} (${sisa})`;
        });
    });
</script>
