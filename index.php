<?php
// ============================================
// File: index.php (Halaman Beranda)
// ============================================

require "cek_login.php";
require "koneksi.php";
require "functions.php";

$judul_halaman = "Beranda";

// Ganti sesuai nama pemilik aplikasi
$nama_pengguna = $_SESSION['nama'];

// Statistik
$statistik = ambilStatistik($koneksi);

// Hitung status buku
$tersedia = 0;
$terbatas = 0;
$kosong   = 0;

$query_status = mysqli_query($koneksi, "SELECT stok FROM buku");

while ($data = mysqli_fetch_assoc($query_status)) {

    if ($data['stok'] > 5) {
        $tersedia++;
    } elseif ($data['stok'] > 0) {
        $terbatas++;
    } else {
        $kosong++;
    }
}

// Ucapan berdasarkan waktu
$jam = (int) date("H");

if ($jam >= 5 && $jam < 12) {
    $sambutan = "Selamat Pagi";
} elseif ($jam >= 12 && $jam < 15) {
    $sambutan = "Selamat Siang";
} elseif ($jam >= 15 && $jam < 18) {
    $sambutan = "Selamat Sore";
} else {
    $sambutan = "Selamat Malam";
}
?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul_halaman; ?> - Sistem Pendataan Buku</title>

<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>

<!-- Navbar -->
<div class="navbar">

    <h1>📚 Sistem Pendataan Buku</h1>

    <nav>
        <a href="index.php">🏠 Beranda</a>
        <a href="daftar.php">📖 Daftar Data</a>
        <a href="tambah.php">➕ Tambah Data</a>
        <a href="logout.php"> Logout</a>
    </nav>

</div>

<!-- Container -->
<div class="container">

    <!-- Hero -->
   <div class="card hero">

    <h4 class="greeting">
        <?= $sambutan ?>,
        <?= $nama_pengguna ?> 👋
    </h4>

    <h2>
        Dashboard Manajemen Buku
    </h2>

    <p class="tanggal">
        📅 <?= date("d F Y"); ?>
    </p>

        <p>
            Kelola data buku perpustakaan dengan lebih mudah,
            cepat, dan terorganisir melalui sistem pendataan buku.
        </p>

        <div class="hero-buttons">

            <a href="daftar.php" class="btn btn-primary">
                📖 Lihat Daftar Buku
            </a>

            <a href="tambah.php" class="btn btn-success">
                ➕ Tambah Buku Baru
            </a>

        </div>

        <!-- Statistik -->
        <div class="stat-grid">

            <div class="stat-box">
                <div class="stat-icon">📚</div>
                <h3><?= $statistik['judul']; ?></h3>
                <p>Total Judul Buku</p>
            </div>

            <div class="stat-box">
                <div class="stat-icon">📦</div>
                <h3><?= $statistik['stok']; ?></h3>
                <p>Total Stok Buku</p>
            </div>

            <div class="stat-box">
                <div class="stat-icon">✅</div>
                <h3><?= $tersedia; ?></h3>
                <p>Buku Tersedia</p>
            </div>

            <div class="stat-box">
                <div class="stat-icon">⚠️</div>
                <h3><?= $terbatas; ?></h3>
                <p>Stok Terbatas</p>
            </div>

            <div class="stat-box">
                <div class="stat-icon">❌</div>
                <h3><?= $kosong; ?></h3>
                <p>Stok Kosong</p>
            </div>

        </div>

        <!-- Buku Terbaru -->
        <div class="recent-books">

            <h3>📖 Buku Terbaru</h3>

            <div class="table-responsive">

                <table>

                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php

                    $query_buku = mysqli_query(
                        $koneksi,
                        "SELECT * FROM buku ORDER BY id DESC LIMIT 5"
                    );

                    while($buku = mysqli_fetch_assoc($query_buku)){

                    ?>

                        <tr>
                            <td><?= htmlspecialchars($buku['judul']); ?></td>
                            <td><?= htmlspecialchars($buku['penulis']); ?></td>
                            <td><?= htmlspecialchars($buku['kategori']); ?></td>
                            <td><?= $buku['stok']; ?></td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

            <br>

            <a href="daftar.php" class="btn btn-primary">
                📖 Lihat Semua Buku
            </a>

        </div>

    </div>

</div>

<!-- Footer -->
<footer>
    &copy; <?= date("Y"); ?>
    Sistem Pendataan Buku - UAS Pemrograman Web
</footer>
```

</body>
</html>
