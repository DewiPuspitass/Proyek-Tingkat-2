<section class="bg-white p-6 rounded-xl shadow">
    <header>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Ubah Kata Sandi</h2>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4" id="password-form">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Kata Sandi Lama</label>
            <input type="password" id="current_password" name="current_password"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
            <input type="password" id="password" name="password"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
               class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
               autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition">
                Perbarui Kata Sandi
            </button>
        </div>
    </form>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status') === 'password-updated')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 focus:outline-none",
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Password berhasil diperbarui.',
                confirmButtonText: 'OK',
            });

            // Reset form dan hapus localStorage
            const form = document.getElementById('password-form');
            form.reset();
            localStorage.removeItem('old_password');
            localStorage.removeItem('old_confirmation');
        });
    </script>
@endif

<script>
    const form = document.getElementById('password-form');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Cegah submit langsung

        const currentPassword = document.getElementById('current_password').value.trim();
        const newPassword = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('password_confirmation').value.trim();

        // Validasi dasar sebelum konfirmasi
        if (!currentPassword || !newPassword || !confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Semua kolom wajib diisi!',
                confirmButtonColor: '#f97316'
            });
            return;
        }

        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Password tidak cocok!',
                text: 'Password baru dan konfirmasi harus sama.',
                confirmButtonColor: '#f97316'
            });
            return;
        }

        // Simpan input ke localStorage untuk antisipasi reload
        localStorage.setItem('old_password', newPassword);
        localStorage.setItem('old_confirmation', confirmPassword);

        // SweetAlert konfirmasi
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 focus:outline-none",
                cancelButton: "bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 ml-2"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Yakin ingin mengubah password?',
            text: "Pastikan password baru sudah benar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, ubah!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Kirim form setelah konfirmasi
            }
        });
    });

    // Restore input jika reload
    window.addEventListener('DOMContentLoaded', function () {
        const oldPass = localStorage.getItem('old_password');
        const oldConfirm = localStorage.getItem('old_confirmation');

        if (oldPass !== null) {
            document.getElementById('password').value = oldPass;
        }

        if (oldConfirm !== null) {
            document.getElementById('password_confirmation').value = oldConfirm;
        }

        localStorage.removeItem('old_password');
        localStorage.removeItem('old_confirmation');
    });
</script>


