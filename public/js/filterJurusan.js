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
                $("#lowonganTable tbody").html(""); // Kosongkan tabel dulu



                    response.forEach(l => {
                    console.log(l.lowongan_id);
                    console.log(l);

                    $("#lowonganTable tbody").append(`
                        <tr>
                            <td>${l.lowongan_kerja.nama_pekerjaan}</td>
                            <td>${l.lowongan_kerja.nama_perusahaan}</td>
                            <td>${l.lowongan_kerja.domisili_penempatan}</td>
                            <td>${l.lowongan_kerja.tanggal_post}</td>
                            <td>
                                <a href="/lowongan_pekerjaan/${l.lowongan_kerja.id}">Info</a>
                                <a href="/lowongan_pekerjaan/${l.lowongan_kerja.id}/edit">Edit</a>
                                <form action="/lowongan_pekerjaan/${l.lowongan_kerja.id}" method="POST" style="display: inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" onclick="return confirm('Apakah anda ingin menghapus Lowongan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
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
