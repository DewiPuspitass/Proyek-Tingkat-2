$(function () {


    function clearHighlight() {
        $('input, select, textarea').removeClass('border-red-500');
        $('.text-red-600.text-sm').remove();
    }

    function highlightInvalidField(field, message) {
        field.addClass('border-red-500');
        field.after('<span class="text-red-600 text-sm">' + message + '</span>');
    }


    $(document).on('click', '#simpan', function (e) {
        e.preventDefault();

        clearHighlight();

        let isValid = true;

        if (!$('input[name="nama_berkas"]').val()) {
            highlightInvalidField($('input[name="nama_berkas"]'), 'Nama Pekerjaan wajib diisi');
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

        const form = document.querySelector("form");


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
