<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="margin-left: 2em;">
    <h1>Lowongan Kerja</h1>

    @if (session()->has('success'))
        <span style="color: green;">{{ session('success') }}</span>
    @endif

    <a href="{{ route('lowongan_pekerjaan.create') }}">Tambah Lowongan Kerja</a> <br><br>

    <form action="{{ route('lowongan_pekerjaan.index') }}" method="GET" class="mb-4">
        <input type="text" id="search" name="search" placeholder="Cari pekerjaan..." class="border p-2 rounded">
    </form>

    <table style="margin-top: 1em;" border="1">
        <thead>
            <tr>
                <th>Nama Pekerjaan</th>
                <th>Nama Perusahaan</th>
                <th>Domisili Penempatan</th>
                <th>Tanggal Post</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="job-list">
            @include('lowongan_pekerjaan.table')
        </tbody>
    </table>

    {{ $lowongan_pekerjaan->links() }}
    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                let query = $(this).val();
                
                $.ajax({
                    url: "{{ route('lowongan_pekerjaan.index') }}",
                    type: "GET",
                    data: { search: query },
                    success: function (data) {
                        $('tbody').html(data);
                    }
                });
            });
        });
    </script>

</body>
</html>
