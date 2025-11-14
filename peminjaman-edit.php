<?php
include_once "config/db-config.php";
include_once "config/class-peminjaman.php";
include_once "config/class-buku.php";
include_once "config/class-anggota.php";

$peminjaman = new Peminjaman($koneksi);
$buku = new Buku($koneksi);
$anggota = new Anggota($koneksi);

if(!isset($_GET['id'])){
    header("Location: peminjaman-list.php");
    exit;
}

$id = $_GET['id'];
$data = $peminjaman->getById($id);

if(!$data){
    echo "<script>alert('Data tidak ditemukan!'); window.location='peminjaman-list.php';</script>";
    exit;
}

$bukuData = $buku->tampilData();
$anggotaData = $anggota->tampilData();

if(isset($_POST['submit'])){
    $_POST['id_peminjaman'] = $id;
    if($peminjaman->update($_POST)){
        header("Location: peminjaman-list.php?alert=info&msg=".urlencode('✅ Peminjaman berhasil diperbarui.'));
        exit;
    } else {
        header("Location: peminjaman-list.php?alert=danger&msg=".urlencode('❌ Gagal memperbarui peminjaman.'));
        exit;
    }
}

include "template/header.php";
?>

<h3>Edit Peminjaman</h3>
<form method="POST">
  <div class="mb-3">
    <label>Nama Anggota</label>
    <select name="id_anggota" class="form-control" required>
      <option value="">-- Pilih Anggota --</option>
      <?php while($row = $anggotaData->fetch_assoc()): ?>
        <option value="<?= $row['id_anggota'] ?>" <?= $row['id_anggota']==$data['id_anggota']?'selected':'' ?>>
            <?= $row['nama'] ?>
        </option>
      <?php endwhile; ?>
    </select>
  </div>
  
  <div class="mb-3">
    <label>Judul Buku</label>
    <select name="id_buku" class="form-control" required>
      <option value="">-- Pilih Buku --</option>
      <?php while($row = $bukuData->fetch_assoc()): ?>
        <option value="<?= $row['id_buku'] ?>" <?= $row['id_buku']==$data['id_buku']?'selected':'' ?>>
            <?= $row['judul'] ?>
        </option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-3">
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam'] ?>" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Tanggal Kembali</label>
    <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali'] ?>" class="form-control" required>
  </div>

  <div class="mb-3">
  <label>Status</label>
  <select name="status" class="form-control">
    <option value="Dipinjam" <?= $data['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
    <option value="Dikembalikan" <?= $data['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
  </select>
</div>


  <button type="submit" name="submit" class="btn btn-primary">Update</button>
  <a href="peminjaman-list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include "template/footer.php"; ?>
