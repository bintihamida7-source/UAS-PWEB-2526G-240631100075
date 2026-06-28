<?php

// ============================================
// File: functions.php
// ============================================

// Membersihkan input dari user
function bersihkanInput($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Menentukan status stok buku
function statusStok($stok)
{
    $stok = (int) $stok;

    if ($stok > 5) {
        return [
            "label" => "Tersedia",
            "class" => "badge-hijau"
        ];
    } elseif ($stok > 0) {
        return [
            "label" => "Terbatas",
            "class" => "badge-kuning"
        ];
    } else {
        return [
            "label" => "Kosong",
            "class" => "badge-merah"
        ];
    }
}

// Mengambil seluruh data buku
function ambilSemuaBuku($koneksi, $keyword = "")
{
    $data = [];

    if ($keyword != "") {

        $keyword = mysqli_real_escape_string($koneksi, $keyword);

        $sql = "SELECT * FROM buku
                WHERE judul LIKE '%$keyword%'
                OR penulis LIKE '%$keyword%'
                OR penerbit LIKE '%$keyword%'
                OR kategori LIKE '%$keyword%'
                ORDER BY id DESC";

    } else {

        $sql = "SELECT * FROM buku ORDER BY id DESC";
    }

    $hasil = mysqli_query($koneksi, $sql);

    while ($baris = mysqli_fetch_assoc($hasil)) {
        $data[] = $baris;
    }

    return $data;
}

// Mengambil statistik buku
function ambilStatistik($koneksi)
{
    $sql = "SELECT COUNT(*) AS total_judul,
                   SUM(stok) AS total_stok
            FROM buku";

    $hasil = mysqli_query($koneksi, $sql);
    $baris = mysqli_fetch_assoc($hasil);

    return [
        "judul" => $baris['total_judul'],
        "stok" => $baris['total_stok'] ? $baris['total_stok'] : 0
    ];
}

// Menghitung jumlah buku berdasarkan status stok
function hitungStatusBuku($koneksi)
{
    $tersedia = 0;
    $terbatas = 0;
    $kosong = 0;

    $query = mysqli_query($koneksi, "SELECT stok FROM buku");

    while ($row = mysqli_fetch_assoc($query)) {

        if ($row['stok'] > 5) {
            $tersedia++;
        } elseif ($row['stok'] > 0) {
            $terbatas++;
        } else {
            $kosong++;
        }
    }

    return [
        "tersedia" => $tersedia,
        "terbatas" => $terbatas,
        "kosong" => $kosong
    ];
}

?>