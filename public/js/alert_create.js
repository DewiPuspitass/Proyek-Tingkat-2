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

        // ... (validasi lainnya tetap)

        // Validasi Link Submit
        const linkSubmitField = $('input[name="link_submit"]');
        let linkVal = linkSubmitField.val().trim();

        if (!linkVal) {
            highlightInvalidField(linkSubmitField, 'Link submit wajib diisi');
            isValid = false;
        } else {
            // Jika hanya angka dan mulai dari 08 (nomor Indonesia)
            if (/^08\d{8,10}$/.test(linkVal)) {
                const intlNumber = '62' + linkVal.substring(1);
                linkSubmitField.val('https://wa.me/' + intlNumber);
            } else if (
                !/^https?:\/\//i.test(linkVal) && // tidak mengandung http/https
                /^[\w.-]+\.[a-z]{2,}$/i.test(linkVal) // domain valid
            ) {
                linkSubmitField.val('https://' + linkVal);
            }
        }

        // ... (validasi lainnya tetap, termasuk foto_loker dll)

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
