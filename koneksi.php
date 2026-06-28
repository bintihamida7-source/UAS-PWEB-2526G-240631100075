<?php

// ============================================
// File : koneksi.php
// Fungsi : Menghubungkan aplikasi dengan
//          database MySQL
// ============================================

// Konfigurasi Database
$host   = "localhost";
$user   = "root";
$pass   = "";
$dbname = "db_buku";

// Membuat koneksi
$koneksi = mysqli_connect(
    $host,
    $user,
    $pass,
    $dbname
);

// Cek koneksi database
if (!$koneksi) {

    die(
        "Koneksi database gagal : " .
        mysqli_connect_error()
    );

}

// Mengatur karakter UTF-8
mysqli_set_charset($koneksi, "utf8");

// Mengatur zona waktu Indonesia
date_default_timezone_set("Asia/Jakarta");

?>
