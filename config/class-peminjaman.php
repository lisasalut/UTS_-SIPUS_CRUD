<?php
include_once "db-config.php";


class Peminjaman {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    // 🔹 Menampilkan semua data peminjaman
    public function tampilData() {
        $query = "
            SELECT p.*, b.judul, a.nama 
            FROM peminjaman p
            JOIN buku b ON p.id_buku = b.id_buku
            JOIN anggota a ON p.id_anggota = a.id_anggota
            ORDER BY p.id_peminjaman DESC
        ";
        return $this->conn->query($query);
    }

    // 🔹 Menambah data peminjaman baru
    public function tambah($data) {
        // Pastikan status valid
        $status = ($data['status'] === 'Dikembalikan') ? 'Dikembalikan' : 'Dipinjam';

        $stmt = $this->conn->prepare("
            INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali, status) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "iisss",
            $data['id_anggota'],
            $data['id_buku'],
            $data['tanggal_pinjam'],
            $data['tanggal_kembali'],
            $status
        );
        return $stmt->execute();
    }

    // 🔹 Mengambil data berdasarkan ID
    public function getById($id) {
        $id = (int)$id;
        $result = $this->conn->query("SELECT * FROM peminjaman WHERE id_peminjaman = $id");
        return $result->fetch_assoc();
    }

    // 🔹 Mengupdate data peminjaman
    public function update($data) {
        // Pastikan status sesuai ENUM
        $status = ($data['status'] === 'Dikembalikan') ? 'Dikembalikan' : 'Dipinjam';

        $stmt = $this->conn->prepare("
            UPDATE peminjaman 
            SET id_anggota=?, id_buku=?, tanggal_pinjam=?, tanggal_kembali=?, status=? 
            WHERE id_peminjaman=?
        ");
        $stmt->bind_param(
            "iisssi",
            $data['id_anggota'],
            $data['id_buku'],
            $data['tanggal_pinjam'],
            $data['tanggal_kembali'],
            $status,
            $data['id_peminjaman']
        );
        return $stmt->execute();
    }

    // 🔹 Menghapus data peminjaman
    public function hapus($id) {
        $id = (int)$id;
        return $this->conn->query("DELETE FROM peminjaman WHERE id_peminjaman = $id");
    }
    
}


?>
