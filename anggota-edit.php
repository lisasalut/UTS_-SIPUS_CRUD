<?php
include_once "config/db-config.php";
include_once "config/class-anggota.php";

$anggota = new Anggota($koneksi);

if(!isset($_GET['id'])){
    header("Location: anggota-list.php");
    exit;
}

$id = $_GET['id'];
$data = $anggota->getById($id);

if(!$data){
    echo "<script>alert('Data tidak ditemukan!'); window.location='anggota-list.php';</script>";
    exit;
}

if(isset($_POST['submit'])){
    $_POST['id_anggota'] = $id;
    if($anggota->update($_POST)){
        header("Location: anggota-list.php?alert=info&msg=".urlencode('✅ Anggota berhasil diperbarui.'));
        exit;
    } else {
        header("Location: anggota-list.php?alert=danger&msg=".urlencode('❌ Gagal memperbarui anggota.'));
        exit;
    }
}

include "template/header.php";
?>

<h3>Edit Anggota</h3>
<form method="POST">
  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= $data['alamat'] ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Telepon</label>
    <input type="text" name="telepon" value="<?= $data['telepon'] ?>" class="form-control" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Update</button>
  <a href="anggota-list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include "template/footer.php"; ?>
