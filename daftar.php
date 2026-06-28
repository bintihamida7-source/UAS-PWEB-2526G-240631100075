<?php
require "koneksi.php";
require "functions.php";
require "cek_login.php";

// Pencarian data
$keyword = isset($_GET['cari']) ? bersihkanInput($_GET['cari']) : "";

// Mengambil data buku
$daftar_buku = ambilSemuaBuku($koneksi, $keyword);
?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data Buku</title>
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

    <h2>Daftar Data Buku</h2>

    <?php if (isset($_GET['status'])) : ?>

        <?php if ($_GET['status'] == "tambah") : ?>
            <p class="alert alert-success">
                Data buku berhasil ditambahkan.
            </p>
        <?php elseif ($_GET['status'] == "edit") : ?>
            <p class="alert alert-success">
                Data buku berhasil diperbarui.
            </p>
        <?php elseif ($_GET['status'] == "hapus") : ?>
            <p class="alert alert-success">
                Data buku berhasil dihapus.
            </p>
        <?php endif; ?>

    <?php endif; ?>

    <form method="GET" action="daftar.php" class="search-bar">
        <input
            type="text"
            name="cari"
            placeholder="Cari judul, penulis, penerbit atau kategori..."
            value="<?= htmlspecialchars($keyword); ?>"
        >

        <button type="submit" class="btn btn-primary">
            Cari
        </button>
    </form>

    <p style="margin-bottom:15px;">
        Total Data :
        <strong><?= count($daftar_buku); ?></strong> Buku
    </p>

    <div class="table-responsive">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php if (count($daftar_buku) > 0) : ?>

                <?php
                $no = 1;

                foreach ($daftar_buku as $buku) :

                    $status = statusStok($buku['stok']);
                ?>

                <tr>
                    <td><?= $no++; ?></td>

                    <td><?= htmlspecialchars($buku['judul']); ?></td>

                    <td><?= htmlspecialchars($buku['penulis']); ?></td>

                    <td><?= htmlspecialchars($buku['penerbit']); ?></td>

                    <td><?= $buku['tahun_terbit']; ?></td>

                    <td><?= htmlspecialchars($buku['kategori']); ?></td>

                    <td><?= $buku['stok']; ?></td>

                    <td>
                        <span class="<?= $status['class']; ?>">
                            <?= $status['label']; ?>
                        </span>
                    </td>

                    <td>
                        <a
                            href="edit.php?id=<?= $buku['id']; ?>"
                            class="btn btn-edit"
                        >
                            ✏ Edit
                        </a>

                        <a
                            href="hapus.php?id=<?= $buku['id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                        >
                            🗑 Hapus
                        </a>
                    </td>
                </tr>

                <?php endforeach; ?>

            <?php else : ?>

                <tr>
                    <td colspan="9" style="text-align:center; padding:40px;">
                        📚 <br><br>
                        Data buku tidak ditemukan
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>
        </table>

    </div>

    <br>

    <a href="tambah.php" class="btn btn-success">
        + Tambah Buku Baru
    </a>

</div>

</div>

<footer>
    &copy; <?= date("Y"); ?> Sistem Pendataan Buku - UAS Pemrograman Web
</footer>

</body>
</html>
