<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "db_sipus";
    public  $koneksi;

    // Konstruktor untuk membuat koneksi otomatis saat class diinisialisasi
    public function __construct() {
        $this->connect();
    }

    // Fungsi untuk membuat koneksi ke database
    private function connect() {
        $this->koneksi = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->koneksi->connect_error) {
            die("Koneksi gagal: " . $this->koneksi->connect_error);
        }
    }

    // Fungsi untuk menutup koneksi
    public function close() {
        if ($this->koneksi) {
            $this->koneksi->close();
        }
    }
}

// Cara pemakaian:
$db = new Database(); // otomatis terkoneksi ke database
$koneksi = $db->koneksi; // akses objek koneksi jika dibutuhkan

// Contoh query:
// $result = $koneksi->query("SELECT * FROM users");
?>
