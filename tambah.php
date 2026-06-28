<?php

require "koneksi.php";
require "functions.php";

$error = "";

// Proses Tambah Data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $judul        = bersihkanInput($_POST['judul']);
    $penulis      = bersihkanInput($_POST['penulis']);
    $penerbit     = bersihkanInput($_POST['penerbit']);
    $tahun_terbit = bersihkanInput($_POST['tahun_terbit']);
    $kategori     = bersihkanInput($_POST['kategori']);
    $stok         = bersihkanInput($_POST['stok']);

    // Validasi Input
    if (
        empty($judul) ||
        empty($penulis) ||
        empty($penerbit) ||
        empty($tahun_terbit) ||
        empty($kategori) ||
        $stok === ""
    ) {

        $error = "Semua field wajib diisi!";

    } elseif ($tahun_terbit < 1900 || $tahun_terbit > date("Y")) {

        $error = "Tahun terbit tidak valid!";

    } elseif ($stok < 0) {

        $error = "Stok tidak boleh kurang dari 0!";

    } else {

        $sql = "INSERT INTO buku
                (judul, penulis, penerbit, tahun_terbit, kategori, stok)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($koneksi, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssssi",
            $judul,
            $penulis,
            $penerbit,
            $tahun_terbit,
            $kategori,
            $stok
        );

        if (mysqli_stmt_execute($stmt)) {

            header("Location: daftar.php?status=tambah");
            exit();

        } else {

            $error = "Gagal menyimpan data: " . mysqli_error($koneksi);

        }
    }
}

?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Buku</title>

<link rel="stylesheet" href="style.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


</head>
<body>

<div class="navbar">

<h1>📚 Sistem Pendataan Buku</h1>
    <nav>
        <a href="index.php">🏠 Beranda</a>
        <a href="daftar.php">📖 Daftar Data</a>
        <a href="tambah.php">➕ Tambah Data</a>
    </nav>

</div>

<div class="container">

<div class="card">

    <h2>Tambah Data Buku</h2>

    <?php if ($error != "") : ?>
        <p class="alert alert-warning">
            <?= $error; ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="tambah.php">

        <label>Judul Buku</label>
        <input
            type="text"
            name="judul"
            required
        >

        <label>Penulis</label>
        <input
            type="text"
            name="penulis"
            required
        >

        <label>Penerbit</label>
        <input
            type="text"
            name="penerbit"
            required
        >

        <label>Tahun Terbit</label>
        <input
            type="number"
            name="tahun_terbit"
            min="1900"
            max="<?= date('Y'); ?>"
            required
        >

        <label>Kategori</label>

        <select name="kategori" required>
            <option value="">
                -- Pilih Kategori --
            </option>

            <option value="Novel">Novel</option>
            <option value="Pemrograman">Pemrograman</option>
            <option value="Pengembangan Diri">Pengembangan Diri</option>
            <option value="Sains">Sains</option>
            <option value="Sejarah">Sejarah</option>
            <option value="Lainnya">Lainnya</option>
        </select>

        <label>Stok</label>

        <input
            type="number"
            name="stok"
            min="0"
            required
        >

        <button type="submit" class="btn btn-success">
            Simpan Data
        </button>

        <a href="daftar.php" class="btn btn-secondary">
            Batal
        </a>

    </form>

</div>

</div>

<footer>
    &copy; <?= date("Y"); ?> Sistem Pendataan Buku - UAS Pemrograman Web
</footer>

</body>
</html>
