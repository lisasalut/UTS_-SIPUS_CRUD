<?php
include_once "../config/db-config.php";
include_once "../config/class-buku.php";

$buku = new Buku($koneksi);

// TAMBAH DATA
if (isset($_POST['submit']) && $_POST['submit'] == 'tambah') {
    if ($buku->tambah($_POST)) {
        header("Location: ../buku-list.php?msg=" . urlencode('Data buku berhasil ditambahkan.'));
    } else {
        header("Location: ../buku-list.php?msg=" . urlencode('Gagal menambahkan data buku.'));
    }
    exit;
}

// UPDATE DATA
if (isset($_POST['submit']) && $_POST['submit'] == 'update') {
    $_POST['id_buku'] = (int)$_POST['id_buku'];
    if ($buku->update($_POST)) {
        header("Location: ../buku-list.php?msg=" . urlencode('Data buku berhasil diperbarui.'));
    } else {
        header("Location: ../buku-list.php?msg=" . urlencode('Gagal memperbarui data buku.'));
    }
    exit;
}

// HAPUS DATA


if (isset($_GET['hapus'])) {
    $id_buku = (int)$_GET['hapus'];

   $hasil = $buku->hapus($id_buku);

if ($hasil['status']) {
    header("Location: ../buku-list.php?alert=success&msg=" . urlencode('✅ ' . $hasil['pesan']));
} else {
    header("Location: ../buku-list.php?alert=danger&msg=" . urlencode('❌ ' . $hasil['pesan']));
}
exit;

}



header("Location: ../buku-list.php");
exit;
?>
