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

        $(".filter-jurusan").change(filterLowongan);
    });

    // Toggle dropdown
    $("#dropdownCheckboxButton").click(function() {
        $("#dropdownJurusan").toggleClass("hidden");
    });

    // Fungsi filter lowongan
    function filterLowongan() {
        let selectedJurusan = $(".filter-jurusan:checked").map(function() {
            return $(this).val();
        }).get();

        if (selectedJurusan.length == 0) {
            location.reload();
            return;
        }

        $.ajax({
            url: "/get-lowongan",
            type: "GET",
            data: { jurusan: selectedJurusan },
            success: function(response) {
                const jobList = $("#job-list");
                jobList.empty();

                const activeLowongan = response.filter(l => l.lowongan_kerja.status === 'Aktif');

                if (activeLowongan.length === 0) {
                    jobList.html(`<div class="col-span-3 text-center text-gray-500">Tidak ada lowongan untuk jurusan ini</div>`);
                    return;
                }

                activeLowongan.forEach(l => {
                    const job = l.lowongan_kerja;
                    const isPastDeadline = new Date(job.batas_submit) < new Date();
                    const logoHtml = job.foto_loker ?
                        `<img src="/storage/${job.foto_loker}" alt="Logo" class="w-full h-full object-contain">` :
                        `<span class="text-gray-400 text-sm">Logo</span>`;

                    // Format date
                    const postDate = new Date(job.tanggal_post);
                    const formattedDate = postDate.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });

                    // Card HTML
                    const cardHtml = `
                        <div class="flex items-start p-4 border-b border-gray-200 hover:bg-gray-50">
                            <div class="w-16 h-16 flex-shrink-0 rounded-md overflow-hidden mr-4 bg-gray-100 flex items-center justify-center">
                                ${logoHtml}
                            </div>

                            <div class="flex-1">
                                <h3 class="text-base font-semibold text-gray-800">${job.nama_pekerjaan}</h3>
                                <p class="text-sm text-gray-600">${job.nama_perusahaan}</p>
                                <p class="text-xs text-gray-500">${job.domisili_penempatan || '-'}</p>
                                <p class="text-xs text-gray-400 mt-1">${formattedDate}</p>
                                <p class="text-xs font-semibold mt-1">
                                    Status:
                                    <span class="${job.status === 'Aktif' ? 'text-green-600' : 'text-red-600'}">
                                        ${job.status}
                                    </span>
                                    ${job.status === 'Aktif' && isPastDeadline ?
                                        '<span class="text-yellow-600">(batas submit lewat)</span>' : ''}
                                </p>
                            </div>

                            <div class="ml-4">
                                <a href="/lowongan_pekerjaan/${job.id}" class="text-blue-600 hover:underline text-sm">Info</a>
                            </div>
                        </div>
                    `;

                    jobList.append(cardHtml);
                });
            }
        });
    }

    // Close dropdown when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest("#dropdownCheckboxButton, #dropdownJurusan").length) {
            $("#dropdownJurusan").addClass("hidden");
        }
    });
});
