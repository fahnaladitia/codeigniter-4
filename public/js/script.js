// tombol-hapus
$(".tombol-hapus").on("click", function (e) {
  e.preventDefault();

  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah Anda yakin?",
    text: "data Komik Akan dihapus!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus Data!",
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = href;
    }
  });
});
