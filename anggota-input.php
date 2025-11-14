<?php
include_once "config/db-config.php";
include_once "config/class-anggota.php";

$anggota = new Anggota($koneksi);

if(isset($_POST['submit'])){
    if($anggota->tambah($_POST)){
        header("Location: anggota-list.php?alert=success&msg=".urlencode('✅ Anggota berhasil ditambahkan.'));
        exit;
    } else {
        header("Location: anggota-list.php?alert=danger&msg=".urlencode('❌ Gagal menambahkan anggota.'));
        exit;
    }
}

include "template/header.php";
?>

<h3>Tambah Anggota</h3>
<form method="POST">
  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Alamat</label>
    <input type="text" name="alamat" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Telepon</label>
    <input type="text" name="telepon" class="form-control" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
  <a href="anggota-list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include "template/footer.php"; ?>
