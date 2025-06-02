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

        const namaBerkas = $('input[name="nama_berkas"]').val();
        const hurufSaja = /^[A-Za-z\s]+$/;

        if (!namaBerkas) {
            highlightInvalidField($('input[name="nama_berkas"]'), 'Nama berkas wajib diisi');
            isValid = false;
        } else if (!hurufSaja.test(namaBerkas)) {
            highlightInvalidField($('input[name="nama_berkas"]'), 'Nama berkas hanya boleh berisi huruf dan spasi');
            isValid = false;
        }

        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Mohon Perbaiki Inputan Yang Salah!'
            });
            return;
        }

        const form = e.target.closest("form");
        form.submit();
    });

});
