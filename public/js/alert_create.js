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

    function highlightInvalidField2(element, message) {
        let errorMessage = `<div class="text-red-600 text-sm mt-2">${message}</div>`;
        element.closest('.mb-4').find('.text-red-600').remove();
        element.closest('.mb-4').append(errorMessage);
    }

    function clearHighlight() {
        $('input, select, textarea').removeClass('border-red-500');
        $('.text-red-600.text-sm').remove();
    }

    $(document).on('click', '#simpan', function (e) {
        e.preventDefault();
        clearHighlight();

        let isValid = true;

        const linkSubmitField = $('input[name="link_submit"]');
        let linkVal = linkSubmitField.val().trim();

        if (!linkVal) {
            highlightInvalidField(linkSubmitField, 'Link submit wajib diisi');
            isValid = false;
        } else {
            if (/^08\d{8,10}$/.test(linkVal)) {
                const intlNumber = '62' + linkVal.substring(1);
                linkSubmitField.val('https://wa.me/' + intlNumber);
            } else if (
                !/^https?:\/\//i.test(linkVal) && 
                /^[\w.-]+\.[a-z]{2,}$/i.test(linkVal) 
            ) {
                linkSubmitField.val('https://' + linkVal);
            }
        }
        
        // Nama Pekerjaan
const namaPekerjaan = $('input[name="nama_pekerjaan"]');
if (!namaPekerjaan.val().trim()) {
    highlightInvalidField(namaPekerjaan, 'Nama pekerjaan wajib diisi');
    isValid = false;
}

// Nama Perusahaan
const namaPerusahaan = $('input[name="nama_perusahaan"]');
if (!namaPerusahaan.val().trim()) {
    highlightInvalidField(namaPerusahaan, 'Nama perusahaan wajib diisi');
    isValid = false;
}

// Domisili Penempatan
const domPenempatan = $('select[name="domisili_penempatan"]');
if (!domPenempatan.val()) {
    highlightInvalidField(domPenempatan, 'Domisili penempatan wajib dipilih');
    isValid = false;
}

// Domisili Perusahaan
const domPerusahaan = $('select[name="domisili_perusahaan"]');
if (!domPerusahaan.val()) {
    highlightInvalidField(domPerusahaan, 'Domisili perusahaan wajib dipilih');
    isValid = false;
}

// Jurusan
if ($('input[name="jurusan[]"]:checked').length === 0) {
    highlightInvalidField2($('input[name="jurusan[]"]').last(), 'Minimal satu jurusan harus dipilih');
    isValid = false;
}

// Tipe Lowongan
if ($('input[name="tipe_lowongan[]"]:checked').length === 0) {
    highlightInvalidField2($('input[name="tipe_lowongan[]"]').last(), 'Minimal satu tipe lowongan harus dipilih');
    isValid = false;
}

// Gaji
const gajiField = $('input[name="gaji"]');
if (!gajiField.val().trim() || isNaN(gajiField.val())) {
    highlightInvalidField(gajiField, 'Gaji wajib diisi dengan angka');
    isValid = false;
}

// Deskripsi
const deskripsi = $('textarea[name="deskripsi"]');
if (!deskripsi.val().trim()) {
    highlightInvalidField(deskripsi, 'Deskripsi wajib diisi');
    isValid = false;
}

// Kualifikasi
const kualifikasi = $('textarea[name="kualifikasi"]');
if (!kualifikasi.val().trim()) {
    highlightInvalidField(kualifikasi, 'Kualifikasi wajib diisi');
    isValid = false;
}

const foto = $('input[name="foto_loker"]');
const isEdit = $('#page-context').val() === 'edit';

if (!isEdit && foto.get(0).files.length === 0) {
    highlightInvalidField(foto, 'Foto lowongan wajib diunggah');
    isValid = false;
} else if (foto.get(0).files.length > 0) {
    const file = foto.get(0).files[0];
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!allowedTypes.includes(file.type) || file.size > 2 * 1024 * 1024) {
        highlightInvalidField(foto, 'File harus gambar (jpeg/png/jpg) dan max 2MB');
        isValid = false;
    }
}


// Persyaratan Berkas
if ($('input[name="persyaratan_berkas[]"]:checked').length === 0) {
    highlightInvalidField2($('input[name="persyaratan_berkas[]"]').last(), 'Minimal satu berkas harus dipilih');
    isValid = false;
}

// Link Submit (sudah ada pengecekan di atas)
if (!linkVal || !/^https?:\/\//.test(linkVal)) {
    highlightInvalidField(linkSubmitField, 'Link submit wajib berupa URL valid');
    isValid = false;
}

// Batas Submit
const batasSubmit = $('input[name="batas_submit"]');
if (!batasSubmit.val()) {
    highlightInvalidField(batasSubmit, 'Batas submit wajib diisi');
    isValid = false;
}


        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mohon Perbaiki Inputan Yang Salah'
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
                }).then(() => {
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');
                    if (csrfToken) {
                        $('<input>').attr({
                            type: 'hidden',
                            name: '_token',
                            value: csrfToken
                        }).appendTo('form');
                    }
                    $('form').submit();
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
