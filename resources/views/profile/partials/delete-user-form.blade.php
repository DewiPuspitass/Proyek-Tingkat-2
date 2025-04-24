<section class="bg-white p-6 rounded-xl shadow">
    <header>
        <h2 class="text-lg font-semibold text-red-600 mb-4">Hapus Akun</h2>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4"
          onsubmit="return confirm('Yakin ingin menghapus akun?')">
        @csrf
        @method('delete')

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" id="password" name="password"
                   class="mt-1 block w-full border border-orange-500 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   placeholder="Masukkan password untuk konfirmasi">
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                Hapus Akun
            </button>
        </div>
    </form>
</section>