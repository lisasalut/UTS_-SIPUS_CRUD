<?php
include_once "config/db-config.php";
include_once "config/class-anggota.php";

$anggota = new Anggota($koneksi);
$data = $anggota->tampilData();
include "template/header.php";
?>

<h3>Daftar Anggota</h3>
<a href="anggota-input.php" class="btn btn-success mb-3">+ Tambah Anggota</a>

<?php if(isset($_GET['msg'])): ?>
<div class="alert alert-<?= $_GET['alert'] ?>">
    <?= htmlspecialchars($_GET['msg']); ?>
</div>
<?php endif; ?>

<table class="table table-bordered">
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Alamat</th>
  <th>Telepon</th>
  <th>Aksi</th>
</tr>
<?php $no=1; while($row = $data->fetch_assoc()): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $row['nama'] ?></td>
  <td><?= $row['alamat'] ?></td>
  <td><?= $row['telepon'] ?></td>
  <td>
    <a href="anggota-edit.php?id=<?= $row['id_anggota'] ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="proses/proses-anggota.php?hapus=<?= $row['id_anggota'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus anggota ini?')">Hapus</a>
  </td>
</tr>
<?php endwhile; ?>
</table>

<?php include "template/footer.php"; ?>
