$(document).ready(function () {

    // Setup CSRF token untuk semua AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Ambil daftar jurusan untuk dropdown filter
    $.get("/get-jurusan", function (data) {
        data.forEach(jurusan => {
            $("#jurusanList").append(`
                <li>
                    <input type="checkbox" class="filter-jurusan" value="${jurusan.id}" id="jurusan-${jurusan.id}">
                    <label for="jurusan-${jurusan.id}" class="ml-2">${jurusan.nama_jurusan}</label>
                </li>
            `);
        });

        $(".filter-jurusan").change(filterLowongan);
    });

    $("#dropdownCheckboxButton").click(function () {
        $("#dropdownJurusan").toggleClass("hidden");
    });

    function getDomisiliNameById(id, callback) {
        if (!id) {
            callback('Tidak diketahui');
            return;
        }

        $.get(`/get-domisili?id=${id}`, function (response) {
            callback(response.nama || 'Tidak diketahui');
        }).fail(function () {
            callback('Tidak diketahui');
        });
    }

    function filterLowongan() {
        let selectedJurusan = $(".filter-jurusan:checked").map(function () {
            return $(this).val();
        }).get();

        if (selectedJurusan.length === 0) {
            location.reload();
            return;
        }

        $.ajax({
            url: "/get-lowongan",
            type: "GET",
            data: { jurusan: selectedJurusan },
            success: function (response) {
                const jobList = $("#job-list");
                jobList.empty();

                const activeLowongan = response.filter(l => l.lowongan_kerja.status === 'Aktif');

                if (activeLowongan.length === 0) {
                    jobList.html(`<div class="col-span-full text-center text-gray-500">Tidak ada lowongan untuk jurusan ini</div>`);
                    return;
                }

                activeLowongan.forEach(l => {
                    const job = l.lowongan_kerja;

                    const logoHtml = job.foto_loker ?
                        `<img src="/storage/${job.foto_loker}" alt="Logo" class="w-full h-full object-contain">` :
                        `<span class="text-gray-400 text-sm">Logo</span>`;

                    const deadline = new Date(job.batas_submit);
                    let remainingTime;

                    const now = new Date();
                    const endOfDeadline = new Date(deadline);
                    endOfDeadline.setHours(23, 59, 59, 999);
                    const timeDifference = endOfDeadline - now;

                    if (timeDifference <= 0) {
                        remainingTime = 'Batas submit sudah lewat';
                    } else {
                        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

                        if (days > 30) {
                            const months = Math.floor(days / 30);
                            remainingTime = `${months} bulan lagi`;
                        } else if (days > 0) {
                            remainingTime = `${days} hari`;
                        } else if (hours > 0 || minutes > 0) {
                            remainingTime = `${hours} jam`;
                        } else {
                            remainingTime = 'Hari ini adalah batas submit';
                        }
                    }

                    const formattedDeadline = deadline.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });

                    getDomisiliNameById(job.domisili_penempatan, function (domisiliName) {
                        const jobCard = $(`
                            <div class="job-item relative flex items-center border rounded-lg p-4 shadow-sm bg-white" data-deadline="${job.batas_submit}">
                                <div class="w-16 h-16 flex-shrink-0 rounded-md overflow-hidden mr-4 bg-gray-100 flex items-center justify-center">
                                    ${logoHtml}
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-base font-semibold text-gray-800">${job.nama_pekerjaan}</h3>
                                    <p class="text-sm text-gray-600">${job.nama_perusahaan}</p>
                                    <p class="text-xs text-gray-500">${domisiliName}</p>
                                    <p class="text-xs text-gray-400 mt-1">${formattedDeadline} (${remainingTime})</p>
                                    <span class="admin-status" data-id="${job.id}"></span>
                                </div>

                                <div class="ml-4 flex flex-col items-end gap-1 text-sm">
                                    <a href="/lowongan_pekerjaan/${job.id}" class="text-blue-600 hover:underline">Info</a>
                                    <div class="admin-action" data-id="${job.id}"></div>
                                </div>
                            </div>
                        `);

                        jobList.append(jobCard);

                        $.get('/get-user-role', function (response) {
                            if (response.role === 'admin') {
                                $(`.admin-action[data-id="${job.id}"]`).html(`
                                    <div class="flex flex-col items-end gap-1">
                                        <a href="/lowongan_pekerjaan/${job.id}/edit" class="text-yellow-600 hover:underline">Edit</a>
                                        <button class="delete-btn text-red-600 hover:underline" data-id="${job.id}">Hapus</button>
                                    </div>
                                `);

                                $(`.admin-status[data-id="${job.id}"]`).html(`
                                    <p class="text-xs font-semibold mt-1">
                                        Status:
                                        <span class="${job.status === 'Aktif' ? 'text-green-600' : 'text-red-600'}">
                                            ${job.status}
                                        </span>
                                    </p>
                                `);
                            }
                        });
                    });
                });
            }
        });
    }

    // Delegasi event untuk tombol hapus dengan SweetAlert2
    $(document).on('click', '.delete-btn', function () {
        const jobId = $(this).data('id');
        const token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Lowongan ini akan dihapus secara permanen.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/lowongan_pekerjaan/${jobId}`,
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: token
                    },
                    success: function () {
                        Swal.fire(
                            "Berhasil!",
                            "Lowongan berhasil dihapus.",
                            "success"
                        );
                        filterLowongan(); // perbarui daftar
                    },
                    error: function () {
                        Swal.fire(
                            "Gagal!",
                            "Terjadi kesalahan saat menghapus data.",
                            "error"
                        );
                    }
                });
            }
        });
    });

    // Tutup dropdown saat klik di luar
    $(document).click(function (event) {
        if (!$(event.target).closest("#dropdownCheckboxButton, #dropdownJurusan").length) {
            $("#dropdownJurusan").addClass("hidden");
        }
    });
});
