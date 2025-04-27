<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persyaratan Berkas</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/filterJurusan.js') }}"></script>
    <script src="{{ asset('js/delet_alert.js') }}"></script>
</head>

<body class="pt-24 bg-white min-h-screen flex flex-col">

    {{-- Navigation --}}
    @include('layouts.navigation')

    <main class="flex-grow w-full px-12 mb-12">
        {{-- Flash Message --}}
        @if (session()->has('success'))
            <span class="flex flex-wrap items-center gap-4 mb-6 justify-center text-green-600">{{ session('success') }}</span>
        @endif 
        
        <h2 class="text-2xl font-semibold text-orange-600 mb-6 mt-8  text-center">Persyaratan Berkas yang Tersedia</h2>
        
        <a href="{{ route('persyaratan_berkas.create')}}" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-400 block mb-6 w-max flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Persyaratan Berkas
        </a>

        <div class="w-full">
            <table class="table-auto border-collapse border border-gray-300 w-full shadow-lg rounded-lg">
            <thead class="bg-slate-950 text-white text-left">
    <tr>
        <th class="p-4 text-sm font-bold uppercase">No</th>
        <th class="p-4 text-sm font-bold uppercase">Nama Berkas</th>
        <th class="p-4 text-sm font-bold uppercase">Action</th>
    </tr>
</thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @if (!empty($persyaratan_berkas))
                    @foreach ($persyaratan_berkas as $p)
                            <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="p-4 text-sm text-gray-700">{{ $p->id }}</td>
                                <td class="p-4 text-sm text-gray-700">{{ $p->nama_berkas }}</td>
                                <td class="p-4 text-sm px-4">
                                    <a href="{{ route('persyaratan_berkas.edit', $p->id) }}" class="text-white">
                                        <span class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm mr-2 hover:bg-orange-400">
                                            Edit
                                        </span>

                                    </a>

                                    <form action="{{ route('persyaratan_berkas.destroy', $p->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <span class="bg-red-500 text-white px-4 py-1 rounded-full text-sm cursor-pointer hover:bg-red-400" 
                                            onclick="confirmDelete(event, '{{ $p->id }}')">
                                            Hapus
                                        </span>
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
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')
</body>
</html>
