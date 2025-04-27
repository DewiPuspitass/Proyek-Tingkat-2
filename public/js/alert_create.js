$(function () {

    function highlightInvalidField(field, message) {
        $(field).addClass('border-red-500');
        const container = $(field).closest('.field-container');
        if (container.length) {
            container.find('.text-red-600.text-sm').remove();
            container.append(`<div class="text-red-600 text-sm mt-1">${message}</div>`);
        } else {
            $(field).after(`<div class="text-red-600 text-sm mt-1">${message}</div>`);
        }
    }

    function clearHighlight() {
        $('input, select, textarea').removeClass('border-red-500');
        $('.text-red-600.text-sm').remove();
    }

    $(document).on('click', '#simpan', function (e) {
        e.preventDefault();
        clearHighlight();

        let isValid = true;
        const form = document.querySelector("form");

        // Validasi required fields
        if (!$('input[name="nama_pekerjaan"]').val()) {
            highlightInvalidField($('input[name="nama_pekerjaan"]'), 'Nama Pekerjaan wajib diisi');
            isValid = false;
        }
        if (!$('input[name="nama_perusahaan"]').val()) {
            highlightInvalidField($('input[name="nama_perusahaan"]'), 'Nama Perusahaan wajib diisi');
            isValid = false;
        }
        if (!$('select[name="domisili_penempatan"]').val()) {
            highlightInvalidField($('select[name="domisili_penempatan"]'), 'Domisili Penempatan wajib dipilih');
            isValid = false;
        }
        if (!$('select[name="domisili_perusahaan"]').val()) {
            highlightInvalidField($('select[name="domisili_perusahaan"]'), 'Domisili Perusahaan wajib dipilih');
            isValid = false;
        }

        const gajiVal = $('input[name="gaji"]').val();
        if (!gajiVal) {
            highlightInvalidField($('input[name="gaji"]'), 'Gaji wajib diisi');
            isValid = false;
        } else if (!/^\d+$/.test(gajiVal)) {
            highlightInvalidField($('input[name="gaji"]'), 'Gaji harus berupa angka');
            isValid = false;
        }

        if (!$('textarea[name="deskripsi"]').val()) {
            highlightInvalidField($('textarea[name="deskripsi"]'), 'Deskripsi wajib diisi');
            isValid = false;
        }
        if (!$('textarea[name="kualifikasi"]').val()) {
            highlightInvalidField($('textarea[name="kualifikasi"]'), 'Kualifikasi wajib diisi');
            isValid = false;
        }

      // Hanya validasi foto jika ini form create
if (window.location.pathname.includes('create')) {
    const fotoBaru = $('input[name="foto_loker"]')[0].files[0];
    if (!fotoBaru) {
        highlightInvalidField($('input[name="foto_loker"]'), 'Foto wajib diunggah');
        isValid = false;
    }
}
        if (!$('input[name="link_submit"]').val()) {
            highlightInvalidField($('input[name="link_submit"]'), 'Link submit wajib diisi');
            isValid = false;
        }
        if (!$('input[name="batas_submit"]').val()) {
            highlightInvalidField($('input[name="batas_submit"]'), 'Batas submit wajib diisi');
            isValid = false;
        }
        if ($('input[name="jurusan[]"]:checked').length === 0) {
            highlightInvalidField($('input[name="jurusan[]"]').last(), 'Pilih minimal satu jurusan');
            isValid = false;
        }
        if ($('input[name="tipe_lowongan[]"]:checked').length === 0) {
            highlightInvalidField($('input[name="tipe_lowongan[]"]').last(), 'Pilih minimal satu tipe lowongan');
            isValid = false;
        }
        if ($('input[name="persyaratan_berkas[]"]:checked').length === 0) {
            highlightInvalidField($('input[name="persyaratan_berkas[]"]').last(), 'Pilih minimal satu persyaratan berkas');
            isValid = false;
        }

        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mohon lengkapi semua field yang diwajibkan sebelum menyimpan! dan perbaiki input yang salah yang ada'
            });
            return;
        }

        const swalWithTailwindButtons = Swal.mixin({
            customClass: {
                confirmButton: "bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2",
                cancelButton: "bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
            },
            buttonsStyling: false
        });

        swalWithTailwindButtons.fire({
            title: "Apakah kamu yakin?",
            text: "Pastikan data sudah benar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, simpan!",
            cancelButtonText: "Batal",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Berhasil disimpan!',
                    text: 'Lowongan berhasil disimpan!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });


            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithTailwindButtons.fire({
                    title: "Dibatalkan",
                    text: "Data tidak jadi disimpan",
                    icon: "info"
                });
            }
        });
    });
});
