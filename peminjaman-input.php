<?php
include_once "config/db-config.php";
include_once "config/class-peminjaman.php";
include_once "config/class-buku.php";
include_once "config/class-anggota.php";

$peminjaman = new Peminjaman($koneksi);
$buku = new Buku($koneksi);
$anggota = new Anggota($koneksi);

$bukuData = $buku->tampilData();
$anggotaData = $anggota->tampilData();

if (isset($_POST['submit'])) {
    if ($peminjaman->tambah($_POST)) {
        header("Location: peminjaman-list.php?alert=success&msg=" . urlencode('✅ Peminjaman berhasil ditambahkan.'));
        exit;
    } else {
        header("Location: peminjaman-list.php?alert=danger&msg=" . urlencode('❌ Gagal menambahkan peminjaman.'));
        exit;
    }
}

include "template/header.php";
?>

<h3>Tambah Peminjaman</h3>
<form method="POST">
  <div class="mb-3">
    <label>Nama Anggota</label>
    <select name="id_anggota" class="form-control" required>
      <option value="">-- Pilih Anggota --</option>
      <?php while ($row = $anggotaData->fetch_assoc()): ?>
        <option value="<?= $row['id_anggota'] ?>"><?= $row['nama'] ?></option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-3">
    <label>Judul Buku</label>
    <select name="id_buku" class="form-control" required>
      <option value="">-- Pilih Buku --</option>
      <?php while ($row = $bukuData->fetch_assoc()): ?>
        <option value="<?= $row['id_buku'] ?>"><?= $row['judul'] ?></option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-3">
    <label>Tanggal Pinjam</label>
    <!-- ✅ gunakan nama yang sama dengan class-peminjaman -->
    <input type="date" name="tanggal_pinjam" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Tanggal Kembali</label>
    <!-- ✅ gunakan nama yang sama dengan class-peminjaman -->
    <input type="date" name="tanggal_kembali" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
      <option value="Dipinjam">Dipinjam</option>
      <option value="Dikembalikan">Dikembalikan</option>
    </select>
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
  <a href="peminjaman-list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include "template/footer.php"; ?>
