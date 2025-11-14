<?php
include_once "config/db-config.php";
include_once "config/class-buku.php";

$buku = new Buku($koneksi);

if(isset($_POST['submit'])){
    if($buku->tambah($_POST)){
        header("Location: buku-list.php?alert=success&msg=".urlencode('✅ Buku berhasil ditambahkan.'));
        exit;
    } else {
        header("Location: buku-list.php?alert=danger&msg=".urlencode('❌ Gagal menambahkan buku.'));
        exit;
    }
}

include "template/header.php";
?>

<h3>Tambah Buku</h3>
<form method="POST">
  <div class="mb-3">
    <label>Judul Buku</label>
    <input type="text" name="judul" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Pengarang</label>
    <input type="text" name="pengarang" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Penerbit</label>
    <input type="text" name="penerbit" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Tahun Terbit</label>
    <input type="number" name="tahun_terbit" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Kategori</label>
    <input type="text" name="kategori" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
  <a href="buku-list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include "template/footer.php"; ?>
