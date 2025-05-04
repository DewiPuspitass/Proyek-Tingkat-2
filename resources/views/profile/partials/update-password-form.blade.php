<section class="bg-white p-6 rounded-xl shadow">
    <header>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Ubah Kata Sandi</h2>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Kata Sandi Lama</label>
            <input type="password" id="current_password" name="current_password"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   autocomplete="current-password">
                   @error('current_password', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
            <input type="password" id="password" name="password"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   autocomplete="new-password">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   autocomplete="new-password">
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition">
                Perbarui Kata Sandi
            </button>
        </div>
    </form>
</section>
