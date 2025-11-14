<?php
include_once "../config/db-config.php";  // tambahkan koneksi
include_once "../config/class-anggota.php";

$anggota = new Anggota($koneksi);

if (isset($_GET['hapus'])) {
    $id_anggota = (int)$_GET['hapus']; // ✅ gunakan nama variabel yang benar

    $hasil = $anggota->hapus($id_anggota); // ✅ kirim ke method hapus()

    if ($hasil['status']) {
        header("Location: ../anggota-list.php?alert=success&msg=" . urlencode('✅ ' . $hasil['pesan']));
    } else {
        header("Location: ../anggota-list.php?alert=danger&msg=" . urlencode('❌ ' . $hasil['pesan']));
    }
    exit;
}
?>
