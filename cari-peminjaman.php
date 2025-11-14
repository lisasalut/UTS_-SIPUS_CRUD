<?php
// Include koneksi dan class Peminjaman
require_once "config/db-config.php";
include "template/header.php"; 

class Peminjaman {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll($cari = "", $status = "") {
        $query = "
            SELECT p.*, b.judul, a.nama
            FROM peminjaman p
            JOIN buku b ON p.id_buku = b.id_buku
            JOIN anggota a ON p.id_anggota = a.id_anggota
        ";
        $conditions = [];

        if (!empty($cari)) {
            $cari = $this->conn->real_escape_string($cari);
            $conditions[] = "(a.nama LIKE '%$cari%' OR b.judul LIKE '%$cari%')";
        }

        if (!empty($status)) {
            $status = $this->conn->real_escape_string($status);
            $conditions[] = "p.status = '$status'";
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY p.id_peminjaman DESC";

        return $this->conn->query($query);
    }
}

// Buat koneksi
$db = new Database();
$koneksi = $db->koneksi;

// Inisialisasi class Peminjaman
$peminjaman = new Peminjaman($koneksi);

// Ambil parameter GET
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$tampilkanSemua = isset($_GET['tampilkan_semua']) ? true : false;

// Tentukan apakah tabel akan ditampilkan
$showTable = $tampilkanSemua || !empty($cari) || !empty($status);

// Ambil data jika perlu
$result = $showTable ? $peminjaman->getAll($cari, $status) : null;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cari Data Peminjaman</title>
    <!-- 🔗 Panggil file CSS dari folder assets -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>


<h2>🔎 Cari Data Peminjaman</h2>

<form method="GET" action="">
    <input type="text" name="cari" placeholder="Cari nama anggota / judul buku..." value="<?= htmlspecialchars($cari) ?>">

    <select name="status">
        <option value="">-- Semua Status --</option>
        <option value="Dipinjam" <?= ($status == 'Dipinjam') ? 'selected' : '' ?>>Dipinjam</option>
        <option value="Dikembalikan" <?= ($status == 'Dikembalikan') ? 'selected' : '' ?>>Dikembalikan</option>
    </select>

    <button type="submit">Cari</button>
    <a href="cari-peminjaman.php"><button type="button" style="background:#6c757d;">Reset</button></a>
    <button type="submit" name="tampilkan_semua" value="1" style="background:#28a745;">Tampilkan Semua</button>
</form>

<?php if ($showTable): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Anggota</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_peminjaman'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['tanggal_pinjam'] ?></td>
                <td><?= $row['tanggal_kembali'] ?></td>
                <td>
                    <?php if ($row['status'] == 'Dikembalikan'): ?>
                        <span style="color:green;font-weight:bold;">Dikembalikan</span>
                    <?php else: ?>
                        <span style="color:red;font-weight:bold;">Dipinjam</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6" align="center">Tidak ada data ditemukan</td></tr>
    <?php endif; ?>
</table>
<?php endif; ?>

</body>
</html>
<?php include "template/footer.php"; ?> <!-- ✅ Tambahkan ini -->