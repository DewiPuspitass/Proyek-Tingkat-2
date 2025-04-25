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

    <style>
        .opacity-50 { opacity: 0.5; }
        .pointer-events-none { pointer-events: none; }
        .cursor-not-allowed { cursor: not-allowed; }
    </style>
</head>

<body class="pt-24 bg-white min-h-screen flex flex-col"  data-is-admin="{{ auth()->check() && auth()->user()->hasRole('') ? 'true' : 'false' }}">
    {{-- Navigation --}}
    @include('layouts.navigation')

    <main class="flex-grow max-w-7xl mx-auto px-4">
        {{-- Flash Message --}}
        @if (session()->has('success'))
            <span class="flex flex-wrap items-center gap-4 mb-6 justify-center text-green-600">{{ session('success') }}</span>
        @endif

        <div class="flex flex-wrap items-center gap-4 mb-6 justify-center">
            {{-- Search --}}
            <form action="{{ route('lowongan_pekerjaan.index') }}" method="GET" class="flex-1 max-w-md">
                <input type="text" id="search" name="search" placeholder="Cari pekerjaan..."
                    class="border border-black p-2 rounded w-full">
            </form>

            {{-- Filter Dropdown --}}
            <div class="relative">
                <button id="dropdownCheckboxButton" type="button"
                    class="inline-block px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">
                    Filter Jurusan
                    <svg class="w-2.5 h-2.5 ml-2 inline-block" fill="none" viewBox="0 0 10 6">
                        <path d="m1 1 4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div id="dropdownJurusan"
                    class="hidden absolute mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-50 p-3">
                    <ul id="jurusanList" class="space-y-2 text-sm text-gray-700"></ul>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-orange-600 mb-6 text-center">Lowongan Pekerjaan yang Tersedia</h2>

        {{-- Daftar Lowongan --}}
        <div id="job-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @include('lowongan_pekerjaan.table')
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $lowongan_pekerjaan->links() }}
        </div>

        {{-- Script --}}
        <script>
            $(document).ready(function () {
                $('#search').on('keyup', function () {
                    let query = $(this).val();

                    $.ajax({
                        url: "{{ route('lowongan_pekerjaan.index') }}",
                        type: "GET",
                        data: { search: query },
                        success: function (data) {
                            $('#job-list').html($(data).find('#job-list').html());
                            checkJobDeadlines();
                        }
                    });
                });

                function checkJobDeadlines() {
                    const jobItems = document.querySelectorAll('#job-list .job-item');
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    jobItems.forEach(item => {
                        const deadlineStr = item.getAttribute('data-deadline');
                        if (!deadlineStr) return;

                        const deadline = new Date(deadlineStr);
                        deadline.setHours(0, 0, 0, 0);

                        if (deadline < today) {
                            item.classList.add('opacity-50', 'pointer-events-none');

                            const closedBadge = document.createElement('span');
                            closedBadge.className = 'absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded';
                            closedBadge.textContent = 'Ditutup';
                            item.appendChild(closedBadge);

                            const applyButton = item.querySelector('.apply-button');
                            if (applyButton) {
                                applyButton.disabled = true;
                                applyButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                                applyButton.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                            }
                        }
                    });
                }

                checkJobDeadlines();
            });
        </script>
    </main>

    @include('layouts.footer')
</body>
</html>
