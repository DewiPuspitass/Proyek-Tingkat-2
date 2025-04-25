$(document).ready(function() {
    // Mengambil data jurusan untuk dropdown
    $.get("/get-jurusan", function(data) {
        data.forEach(jurusan => {
            $("#jurusanList").append(`
                <li>
                    <input type="checkbox" class="filter-jurusan" value="${jurusan.id}" id="jurusan-${jurusan.id}">
                    <label for="jurusan-${jurusan.id}" class="ml-2">${jurusan.nama_jurusan}</label>
                </li>
            `);
        });

        // Menambahkan event listener untuk checkbox
        $(".filter-jurusan").change(function() {
            filterLowongan();
        });
    });

    // Menampilkan atau menyembunyikan dropdown
    $("#dropdownCheckboxButton").click(function() {
        $("#dropdownJurusan").toggleClass("hidden");
    });

    // Fungsi untuk memfilter lowongan berdasarkan jurusan yang dipilih
    function filterLowongan() {
        let selectedJurusan = $(".filter-jurusan:checked").map(function() {
            return $(this).val();
        }).get();

        if (selectedJurusan.length == 0) {
            location.reload();
        }

        $.ajax({
            url: "/get-lowongan",
            type: "GET",
            data: { jurusan: selectedJurusan },
            success: function(response) {
                const jobList = $("#job-list");
                jobList.empty(); // Kosongkan konten card sebelumnya
            
                if (response.length === 0) {
                    jobList.html(`<div class="col-span-3 text-center text-gray-500">Tidak ada lowongan untuk jurusan ini</div>`);
                    return;
                }
            
                response.forEach(l => {
                    jobList.append(`
                        <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800">${l.lowongan_kerja.nama_pekerjaan}</h3>
                            <p class="text-sm text-gray-500">${l.lowongan_kerja.nama_perusahaan}</p>
                            <p class="text-sm text-gray-600">📍 ${l.lowongan_kerja.domisili_penempatan}</p>
                            <p class="text-xs text-gray-500 mb-4">🗓️ ${l.lowongan_kerja.tanggal_post}</p>
            
                            <div class="flex justify-between items-center mt-4">
                                <a href="/lowongan_pekerjaan/${l.lowongan_kerja.id}" class="text-blue-600 hover:underline text-sm font-medium">Info</a>
                                <a href="/lowongan_pekerjaan/${l.lowongan_kerja.id}/edit" class="text-yellow-600 hover:underline text-sm font-medium">Edit</a>
                                <form action="/lowongan_pekerjaan/${l.lowongan_kerja.id}" method="POST" onsubmit="return confirm('Apakah anda ingin menghapus Lowongan ini?')">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    <button type="submit" class="text-red-600 hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </div>
                    `);
                });
            }

        }); 
    } 
        

    // Menutup dropdown saat klik di luar dropdown
    $(document).click(function(event) {
        if (!$(event.target).closest("#dropdownCheckboxButton, #dropdownJurusan").length) {
            $("#dropdownJurusan").addClass("hidden");
        }
    });
});
