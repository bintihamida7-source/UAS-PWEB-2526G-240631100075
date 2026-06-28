<?php

require "koneksi.php";
require "cek_login.php";

// Cek apakah parameter id tersedia
if (!isset($_GET['id'])) {

    header("Location: daftar.php");
    exit();
}

$id = (int) $_GET['id'];

// Cek apakah data buku benar-benar ada
$sqlCek = "SELECT id FROM buku WHERE id = ?";
$stmtCek = mysqli_prepare($koneksi, $sqlCek);

mysqli_stmt_bind_param($stmtCek, "i", $id);
mysqli_stmt_execute($stmtCek);

$hasil = mysqli_stmt_get_result($stmtCek);

if (mysqli_num_rows($hasil) == 0) {

    header("Location: daftar.php");
    exit();
}

// Proses hapus data
$sql = "DELETE FROM buku WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    header("Location: daftar.php?status=hapus");

} else {

    header("Location: daftar.php?status=gagal");

}

exit();

?>
