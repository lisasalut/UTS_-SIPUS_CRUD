<?php
include_once "config/db-config.php";
include_once "config/class-buku.php";

$buku = new Buku($koneksi);
$data = $buku->tampilData();

include "template/header.php";
?>

<h3>Daftar Buku</h3>

<!-- Notifikasi -->
<?php if (isset($_GET['msg']) && isset($_GET['alert'])): ?>
<div class="alert alert-<?= htmlspecialchars($_GET['alert']); ?>">
    <?= htmlspecialchars($_GET['msg']); ?>
</div>
<?php endif; ?>


<a href="buku-input.php" class="btn btn-success mb-3">+ Tambah Buku</a>

<table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Judul</th>
    <th>Pengarang</th>
    <th>Penerbit</th>
    <th>Tahun</th>
    <th>Kategori</th>
    <th>Jumlah</th>
    <th>Aksi</th>
  </tr>
  <?php $no=1; while($row = $data->fetch_assoc()): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $row['judul'] ?></td>
    <td><?= $row['pengarang'] ?></td>
    <td><?= $row['penerbit'] ?></td>
    <td><?= $row['tahun_terbit'] ?></td>
    <td><?= $row['kategori'] ?></td>
    <td><?= $row['jumlah'] ?></td>
    <td>
      <a href="buku-edit.php?id=<?= $row['id_buku'] ?>" class="btn btn-warning btn-sm">Edit</a>
      <a href="proses/proses-buku.php?hapus=<?= $row['id_buku'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus buku ini?')">Hapus</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<?php include "template/footer.php"; ?>
