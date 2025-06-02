<section class="bg-white p-6 rounded-xl shadow">
    <header>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Profil</h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4" id="profile-form">
        @csrf
        @method('patch')
    
        @hasrole('siswa')
        <div>
            <label for="nis" class="block text-sm font-medium text-gray-700">Nis</label>
            <input type="text" id="nis" name="nis"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('nis', auth()->user()->nis) }}" disabled required>
        </div>
        @endhasrole
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="name" name="name"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('name', auth()->user()->name) }}" required autofocus>
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

        </div>

        <div>
            <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telpon</label>
            <input type="text" id="no_telp" name="no_telp"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('no_telp', auth()->user()->no_telp) }}" required>
            @error('no_telp')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

        </div>


        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email"
                class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                value="{{ old('email', auth()->user()->email) }}"
                disabled required>
        </div>


        @hasrole('siswa')
        <div>
            <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
            <input type="text" id="jurusan" name="jurusan"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('jurusan', auth()->user()->jurusan->nama_jurusan ?? '') }}" disabled required>
        </div>

        <div>
            <label for="tahun_angkatan" class="block text-sm font-medium text-gray-700">Tahun Angkatan</label>
            <input type="text" id="tahun_angkatan" name="tahun_angkatan"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('tahun_angkatan', auth()->user()->tahun_angkatan) }}" disabled required>
        </div>
        @endhasrole

        <div class="pt-4">
            <button type="submit"
                    class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('profile-form');

        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const name = document.getElementById('name').value.trim();
            const noTelp = document.getElementById('no_telp').value.trim();

            if (!name || !noTelp) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama dan No Telpon wajib diisi!',
                    confirmButtonColor: '#f97316'
                });
                return;
            }

            // Konfirmasi dengan SweetAlert
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 focus:outline-none",
                    cancelButton: "bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 ml-2"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Yakin ingin mengubah profil?',
                text: "Perubahan akan disimpan permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</section>
