  <?php
  include_once "config/db-config.php";

  // Hitung total data buku
  $total_buku = $koneksi->query("SELECT COUNT(*) AS total FROM buku")->fetch_assoc()['total'];
  // Hitung total data anggota
  $total_anggota = $koneksi->query("SELECT COUNT(*) AS total FROM anggota")->fetch_assoc()['total'];
  // Hitung total data peminjaman
  $total_peminjaman = $koneksi->query("SELECT COUNT(*) AS total FROM peminjaman")->fetch_assoc()['total'];

  include "template/header.php";
  ?>

      <h4 class="mb-3">📚 Sistem Informasi Perpustakaan (SIPUS)</h4>

      <div class="alert alert-info mb-4 p-2">
        <h6 class="mb-1">Selamat datang di Sistem Informasi Perpustakaan 📖</h6>
        <p class="mb-0 small">
          Aplikasi ini dibuat untuk mengelola data buku, anggota, dan peminjaman secara sederhana.  
          Gunakan menu di sidebar untuk menambahkan atau mengedit data.Semoga aplikasi ini dapat membantu meningkatkan layanan perpustakaan digital.
        </p>
      </div>

      <div class="row text-center">
        <!-- Kartu Buku -->
        <div class="col-md-3 mb-3">
          <div class="card shadow-sm border-0">
            <div class="card-body p-3">
              <h6 class="card-title text-primary mb-1">Buku</h6>
              <i class="bi bi-journal-bookmark-fill text-primary mb-2" style="font-size:1.8rem;"></i>
              <h5><?= $total_buku ?></h5>
              <a href="buku-list.php" class="btn btn-outline-primary btn-sm mt-2">Lihat Data</a>
            </div>
          </div>
        </div>

        <!-- Kartu Anggota -->
        <div class="col-md-3 mb-3">
          <div class="card shadow-sm border-0">
            <div class="card-body p-3">
              <h6 class="card-title text-success mb-1">Anggota</h6>
              <i class="bi bi-people-fill text-success mb-2" style="font-size:1.8rem;"></i>
              <h5><?= $total_anggota ?></h5>
              <a href="anggota-list.php" class="btn btn-outline-success btn-sm mt-2">Lihat Data</a>
            </div>
          </div>
        </div>

        <!-- Kartu Peminjaman -->
        <div class="col-md-3 mb-3">
          <div class="card shadow-sm border-0">
            <div class="card-body p-3">
              <h6 class="card-title text-warning mb-1">Peminjaman</h6>
              <i class="bi bi-arrow-left-right text-warning mb-2" style="font-size:1.8rem;"></i>
              <h5><?= $total_peminjaman ?></h5>
              <a href="peminjaman-list.php" class="btn btn-outline-warning btn-sm mt-2">Lihat Data</a>
            </div>
          </div>
        </div>

        <!-- Kartu Cari Data Peminjaman -->
          <!-- Kartu Cari Data Peminjaman -->
        <div class="col-md-3 mb-3">
          <div class="card shadow-sm border-0">
            <div class="card-body p-3 text-center">
              <h6 class="card-title text-info mb-1">Cari Data Peminjaman</h6>
              <i class="bi bi-search text-info mb-2" style="font-size:1.8rem;"></i>
              <h5 class="mb-2"><?= $total_peminjaman ?></h5>
              <a href="cari-peminjaman.php" class="btn btn-outline-info btn-sm mt-2">
                <i class="bi bi-search"></i> Lihat Data
              </a>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-4">
      <div style="text-align: center; margin-top: 20px; padding: 10px; color: #333; font-weight: 500;"> 
      </div>
      <?php include "template/footer.php"; ?>



