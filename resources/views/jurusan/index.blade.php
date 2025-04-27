<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/filterJurusan.js') }}"></script>
    <script src="{{ asset('js/delet_alert.js') }}"></script>
</head>

<body class="pt-24 bg-white min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('layouts.navigation')

    <main class="flex-grow max-w-7xl mx-auto px-4">
        {{-- Flash Message --}}
        @if (session()->has('success'))
            <span class="flex flex-wrap items-center gap-4 mb-6 justify-center text-green-600">{{ session('success') }}</span>
        @endif

        <table class="table-auto border-collapse border border-gray-300 w-full shadow-lg rounded-lg">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-700 text-white text-left">
                <tr>
                    <th class="p-4 text-sm font-bold uppercase">ID</th>
                    <th class="p-4 text-sm font-bold uppercase">Nama Jurusan</th>
                    <th class="p-4 text-sm font-bold uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if (!empty($jurusan))
                    @foreach ($jurusan as $j)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="p-4 text-sm text-gray-700">{{ $j->id }}</td>
                            <td class="p-4 text-sm text-gray-700">{{ $j->nama_jurusan }}</td>
                            <td class="p-4 text-sm">
                                <a href="{{ route('jurusan.edit', $j->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('jurusan.destroy', $j->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="confirmDelete(event, {{ $j->id }})" 
                                        class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Tidak tersedia</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
</html>
