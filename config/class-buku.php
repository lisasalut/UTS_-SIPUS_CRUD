<?php
include_once "db-config.php";

class Buku {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    // Tampilkan semua data buku
    public function tampilData() {
        return $this->conn->query("SELECT * FROM buku ORDER BY id_buku DESC");
    }

    // Tambah data buku
    public function tambah($data) {
        $stmt = $this->conn->prepare("INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, kategori, jumlah)
                                      VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssisi",
            $data['judul'],
            $data['pengarang'],
            $data['penerbit'],
            $data['tahun_terbit'],
            $data['kategori'],
            $data['jumlah']
        );
        return $stmt->execute();
    }

    // Ambil data berdasarkan ID
    public function getById($id) {
        $id = (int)$id;
        $result = $this->conn->query("SELECT * FROM buku WHERE id_buku = $id");
        return $result->fetch_assoc();
    }

    // Update data buku
    public function update($data) {
        $stmt = $this->conn->prepare("UPDATE buku 
            SET judul=?, pengarang=?, penerbit=?, tahun_terbit=?, kategori=?, jumlah=? 
            WHERE id_buku=?");
        $stmt->bind_param("sssisii",
            $data['judul'],
            $data['pengarang'],
            $data['penerbit'],
            $data['tahun_terbit'],
            $data['kategori'],
            $data['jumlah'],
            $data['id_buku']
        );
        return $stmt->execute();
    }

    // Hapus data buku (cek foreign key dulu)
    public function hapus($id) {
        $id = (int)$id;

        $cek = $this->conn->query("SELECT COUNT(*) AS jumlah FROM peminjaman WHERE id_buku = $id");
        $data = $cek->fetch_assoc();

        if ($data['jumlah'] > 0) {
            return [
                'status' => false,
                'pesan' => 'Tidak dapat menghapus buku ini karena masih dipinjam.'
            ];
        }

        $hapus = $this->conn->query("DELETE FROM buku WHERE id_buku = $id");
        if ($hapus) {
            return [
                'status' => true,
                'pesan' => 'Data buku berhasil dihapus.'
            ];
        } else {
            return [
                'status' => false,
                'pesan' => 'Terjadi kesalahan saat menghapus data buku.'
            ];
        }
    }
}
?>
