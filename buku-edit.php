<?php
include_once "config/db-config.php";
include_once "config/class-buku.php";

$buku = new Buku($koneksi);

if(!isset($_GET['id'])){
    header("Location: buku-list.php");
    exit;
}

$id = $_GET['id'];
$data = $buku->getById($id);

if(!$data){
    echo "<script>alert('Data tidak ditemukan!'); window.location='buku-list.php';</script>";
    exit;
}

if(isset($_POST['submit'])){
    $_POST['id_buku'] = $id;
    if($buku->update($_POST)){
        header("Location: buku-list.php?alert=info&msg=".urlencode('✅ Buku berhasil diperbarui.'));
        exit;
    } else {
        header("Location: buku-list.php?alert=danger&msg=".urlencode('❌ Gagal memperbarui buku.'));
        exit;
    }
}

include "template/header.php";
?>

<h3>Edit Buku</h3>
<form method="POST">
  <div class="mb-3">
    <label>Judul Buku</label>
    <input type="text" name="judul" value="<?= $data['judul'] ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Pengarang</label>
    <input type="text" name="pengarang" value="<?= $data['pengarang'] ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Penerbit</label>
    <input type="text" name="penerbit" value="<?= $data['penerbit'] ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Tahun Terbit</label>
    <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit'] ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Kategori</label>
    <input type="text" name="kategori" value="<?= $data['kategori'] ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Jumlah</label>
    <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Update</button>
  <a href="buku-list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include "template/footer.php"; ?>
