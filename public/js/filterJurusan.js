$(document).ready(function () {

    // Ambil jurusan untuk dropdown
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

    // Toggle dropdown
    $("#dropdownCheckboxButton").click(function () {
        $("#dropdownJurusan").toggleClass("hidden");
    });

    // Fungsi untuk mendapatkan nama domisili berdasarkan ID
    function getDomisiliNameById(id, callback) {
        if (!id) {
            callback('Tidak diketahui');
            return;
        }

        $.get(`/get-domisili?id=${id}`, function (response) {
            if (response.nama) {
                callback(response.nama);
            } else {
                callback('Tidak diketahui');
            }
        }).fail(function () {
            callback('Tidak diketahui');
        });
    }

    // Fungsi filter lowongan
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
                    const now = new Date();
                    const timeDifference = deadline - now;

                    let remainingTime;
                    if (timeDifference <= 0 && now.toDateString() !== deadline.toDateString()) {
                        remainingTime = 'Batas submit sudah lewat';
                    } else {
                        const endOfDay = new Date(deadline);
                        endOfDay.setHours(23, 59, 59, 999);
                        const adjustedTimeDifference = endOfDay - now;

                        const days = Math.floor(adjustedTimeDifference / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((adjustedTimeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((adjustedTimeDifference % (1000 * 60 * 60)) / (1000 * 60));

                        if (days > 30) {
                            const months = Math.floor(days / 30);
                            remainingTime = `${months} bulan lagi`;
                        } else if (days > 0) {
                            remainingTime = `${days} hari lagi`;
                        } else if (hours > 0) {
                            remainingTime = `${hours} jam lagi`;
                        } else {
                            remainingTime = `${minutes} menit lagi`;
                        }
                    }

                    const formattedDeadline = deadline.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });

                    getDomisiliNameById(l.lowongan_kerja.domisili_penempatan, function (domisiliName) {
                        const cardHtml = `
                            <div class="job-item relative flex items-center border rounded-lg p-4 shadow-sm bg-white" data-deadline="${job.batas_submit}">
                                <div class="w-16 h-16 flex-shrink-0 rounded-md overflow-hidden mr-4 bg-gray-100 flex items-center justify-center">
                                    ${logoHtml}
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-base font-semibold text-gray-800">${job.nama_pekerjaan}</h3>
                                    <p class="text-sm text-gray-600">${job.nama_perusahaan}</p>
                                    <p class="text-xs text-gray-500">${domisiliName}</p>
                                    <p class="text-xs text-gray-400 mt-1">${formattedDeadline} (${remainingTime})</p>
                                    <span id="admin-status-${job.id}"></span>
                                </div>

                                <div class="ml-4 flex flex-col items-end gap-1 text-sm">
                                    <a href="/lowongan_pekerjaan/${job.id}" class="text-blue-600 hover:underline">Info</a>
                                    <span id="admin-action-${job.id}"></span>
                                </div>
                            </div>
                        `;

                        jobList.append(cardHtml);

                        // Setelah card ditambahkan, cek role
                        checkRoleForActions(job.id);
                        checkRoleForStatus(job.id, job.status);
                    });
                });
            }
        });
    }

    // Function cek role untuk tombol Edit dan Delete
    function checkRoleForActions(jobId) {
        $.get('/get-user-role', function (response) {
            if (response.role === 'admin') {
                $(`#admin-action-${jobId}`).html(`
                    <div class="flex flex-col items-end gap-1">
                        <a href="/lowongan_pekerjaan/edit/${jobId}" class="text-yellow-600 hover:underline">Edit</a>
                        <button class="text-red-600 hover:underline" onclick="deleteJob(${jobId})">Hapus</button>
                    </div>
                `);
            }
        });
    }

    // Function cek role untuk status
    function checkRoleForStatus(jobId, status) {
        $.get('/get-user-role', function (response) {
            if (response.role === 'admin') {
                $(`#admin-status-${jobId}`).html(`
                    <p class="text-xs font-semibold mt-1">
                        Status:
                        <span class="${status === 'Aktif' ? 'text-green-600' : 'text-red-600'}">
                            ${status}
                        </span>
                    </p>
                `);
            }
        });
    }

    // Fungsi hapus lowongan
    window.deleteJob = function (jobId) {
        if (confirm("Are you sure you want to delete this job?")) {
            $.ajax({
                url: `/delete-lowongan/${jobId}`,
                type: "DELETE",
                success: function (response) {
                    alert("Lowongan deleted successfully!");
                    location.reload();
                },
                error: function (err) {
                    alert("An error occurred while deleting the job.");
                }
            });
        }
    }

    // Close dropdown saat klik di luar
    $(document).click(function (event) {
        if (!$(event.target).closest("#dropdownCheckboxButton, #dropdownJurusan").length) {
            $("#dropdownJurusan").addClass("hidden");
        }
    });
});
