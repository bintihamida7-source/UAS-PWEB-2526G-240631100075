<?php

require "koneksi.php";
require "functions.php";
require "cek_login.php";

$error = "";

// Cek apakah ID tersedia
if (!isset($_GET['id'])) {
    header("Location: daftar.php");
    exit();
}

$id = (int) $_GET['id'];

// Proses Update Data
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

    } elseif ($stok < 0) {

        $error = "Stok tidak boleh kurang dari 0!";

    } elseif ($tahun_terbit < 1900 || $tahun_terbit > date("Y")) {

        $error = "Tahun terbit tidak valid!";

    } else {

        $sql = "UPDATE buku
                SET judul=?,
                    penulis=?,
                    penerbit=?,
                    tahun_terbit=?,
                    kategori=?,
                    stok=?
                WHERE id=?";

        $stmt = mysqli_prepare($koneksi, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssssii",
            $judul,
            $penulis,
            $penerbit,
            $tahun_terbit,
            $kategori,
            $stok,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {

            header("Location: daftar.php?status=edit");
            exit();

        } else {

            $error = "Gagal memperbarui data: " . mysqli_error($koneksi);

        }
    }
}

// Mengambil data lama
$sql = "SELECT * FROM buku WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);
$buku = mysqli_fetch_assoc($hasil);

// Jika data tidak ditemukan
if (!$buku) {
    header("Location: daftar.php");
    exit();
}

// Daftar kategori
$daftar_kategori = [
    "Novel",
    "Pemrograman",
    "Pengembangan Diri",
    "Sains",
    "Sejarah",
    "Lainnya"
];

?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Buku</title>

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

    <h2>Edit Data Buku</h2>

    <?php if ($error != "") : ?>
        <p class="alert alert-warning">
            <?= $error; ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="edit.php?id=<?= $buku['id']; ?>">

        <label>Judul Buku</label>
        <input
            type="text"
            name="judul"
            value="<?= htmlspecialchars($buku['judul']); ?>"
            required
        >

        <label>Penulis</label>
        <input
            type="text"
            name="penulis"
            value="<?= htmlspecialchars($buku['penulis']); ?>"
            required
        >

        <label>Penerbit</label>
        <input
            type="text"
            name="penerbit"
            value="<?= htmlspecialchars($buku['penerbit']); ?>"
            required
        >

        <label>Tahun Terbit</label>
        <input
            type="number"
            name="tahun_terbit"
            min="1900"
            max="<?= date('Y'); ?>"
            value="<?= $buku['tahun_terbit']; ?>"
            required
        >

        <label>Kategori</label>

        <select name="kategori" required>

            <?php foreach ($daftar_kategori as $kat) : ?>

                <option
                    value="<?= $kat; ?>"
                    <?= ($kat == $buku['kategori']) ? "selected" : ""; ?>
                >
                    <?= $kat; ?>
                </option>

            <?php endforeach; ?>

        </select>

        <label>Stok</label>

        <input
            type="number"
            name="stok"
            min="0"
            value="<?= $buku['stok']; ?>"
            required
        >

        <button type="submit" class="btn btn-success">
            Simpan Perubahan
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
