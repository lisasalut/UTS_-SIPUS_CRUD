// ===== KONFIRMASI HAPUS =====
document.addEventListener("DOMContentLoaded", function () {
  const tombolHapus = document.querySelectorAll(".btn-hapus");

  tombolHapus.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      const konfirmasi = confirm("Apakah kamu yakin ingin menghapus data ini?");
      if (!konfirmasi) {
        e.preventDefault();
      }
    });
  });
});

// ===== ANIMASI TOMBOL TAMBAH =====
const btnTambah = document.querySelector(".btn-tambah");
if (btnTambah) {
  btnTambah.addEventListener("mouseenter", () => {
    btnTambah.style.transform = "scale(1.05)";
  });
  btnTambah.addEventListener("mouseleave", () => {
    btnTambah.style.transform = "scale(1)";
  });
}
