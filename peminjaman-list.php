<?php
include_once "config/db-config.php";
include_once "config/class-peminjaman.php";
include_once "config/class-buku.php";
include_once "config/class-anggota.php";

$peminjaman = new Peminjaman($koneksi);
$data = $peminjaman->tampilData();

include "template/header.php";
?>

<h3>Daftar Peminjaman</h3>
<a href="peminjaman-input.php" class="btn btn-success mb-3">+ Tambah Peminjaman</a>

<?php if (isset($_GET['msg']) && isset($_GET['alert'])): ?>
<div class="alert alert-<?= htmlspecialchars($_GET['alert']); ?>">

    <?= htmlspecialchars($_GET['msg']); ?>
</div>
<?php endif; ?>

<table class="table table-bordered">
<tr>
  <th>No</th>
  <th>Nama Anggota</th>
  <th>Judul Buku</th>
  <th>Tanggal Pinjam</th>
  <th>Tanggal Kembali</th>
  <th>Status</th>
  <th>Aksi</th>
</tr>
<?php $no=1; while($row = $data->fetch_assoc()): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $row['nama'] ?></td>
  <td><?= $row['judul'] ?></td>
  <td><?= $row['tanggal_pinjam'] ?></td>
  <td><?= $row['tanggal_kembali'] ?></td>
  <td><?= $row['status'] ?></td>
  <td>
    <a href="peminjaman-edit.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-warning btn-smf">Edit</a>
    <a href="proses/proses-peminjaman.php?hapus=<?= $row['id_peminjaman'] ?>" class="btn btn-danger btn-sm " onclick="return confirm('Hapus peminjaman ini?')">Hapus</a>
  </td>
</tr>
<?php endwhile; ?>
</table>

<?php include "template/footer.php"; ?>
