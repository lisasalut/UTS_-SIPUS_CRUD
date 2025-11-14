<?php
include_once "../config/db-config.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Hapus data berdasarkan ID
    $hapus = $koneksi->query("DELETE FROM peminjaman WHERE id_peminjaman = '$id'");

    if ($hapus) {
        // Jika berhasil, kirim pesan sukses
        header("Location: ../peminjaman-list.php?msg=Data peminjaman berhasil dihapus&alert=success");
    } else {
        // Jika gagal, kirim pesan error
        header("Locacrtion: ../peminjaman-list.php?msg=Gagal menghapus data peminjaman&alert=danger");
    }

    exit;
}
?>
