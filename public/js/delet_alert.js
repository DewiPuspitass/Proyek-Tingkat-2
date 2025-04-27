function confirmDelete(event, id, text) {
    event.preventDefault(); // Menghentikan form submit default
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data ini akan dihapus secara permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form secara manual jika konfirmasi
            event.target.form.submit();
        }
    });
}
