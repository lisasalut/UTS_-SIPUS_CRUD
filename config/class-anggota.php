<?php
include_once "db-config.php";

class Anggota {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function tampilData() {
        return $this->conn->query("SELECT * FROM anggota ORDER BY id_anggota DESC");
    }

    public function tambah($data) {
        $stmt = $this->conn->prepare("INSERT INTO anggota (nama, email, telepon, alamat) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nama'], $data['email'], $data['telepon'], $data['alamat']);
        return $stmt->execute();
    }

    public function getById($id) {
        $result = $this->conn->query("SELECT * FROM anggota WHERE id_anggota = $id");
        return $result->fetch_assoc();
    }

    public function update($data) {
        $stmt = $this->conn->prepare("UPDATE anggota SET nama=?, email=?, telepon=?, alamat=? WHERE id_anggota=?");
        $stmt->bind_param("ssssi", $data['nama'], $data['email'], $data['telepon'], $data['alamat'], $data['id_anggota']);
        return $stmt->execute();
    }

     public function hapus($id) {
        $id = (int)$id;
        $cek = $this->conn->query("SELECT COUNT(*) AS jumlah FROM peminjaman WHERE id_anggota = $id");
        $data = $cek->fetch_assoc();

        if ($data['jumlah'] > 0) {
            return [
                'status' => false,
                'pesan' => 'Tidak dapat menghapus anggota ini karena masih memiliki peminjaman aktif.'
            ];
        }
        $hapus = $this->conn->query("DELETE FROM anggota WHERE id_anggota = $id");
        if ($hapus) {
            return [
                'status' => true,
                'pesan' => 'Data anggota berhasil dihapus.'
            ];
        } else {
            return [
                'status' => false,
                'pesan' => 'Terjadi kesalahan saat menghapus data anggota.'
                ];
        }
    }
}

?>
