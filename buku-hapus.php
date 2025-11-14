<?php
include_once "config/db-config.php";
include_once "config/class-buku.php";

$buku = new Buku($koneksi);

// Cek apakah ada parameter id
if(!isset($_GET['id'])){
    header("Location: buku-list.php");
    exit;
}

$id = $_GET['id'];

// Jalankan proses hapus
if($buku->delete($id)){
    // Jika berhasil
    header("Location: buku-list.php?alert=success&msg=" . urlencode('✅ Buku berhasil dihapus.'));
    exit;
} else {
    // Jika gagal
    header("Location: buku-list.php?alert=danger&msg=" . urlencode('❌ Gagal menghapus buku.'));
    exit;
}
?>
