# 📚 Sistem Pendataan dan Manajemen Stok Buku Berbasis Web

Project ini merupakan aplikasi berbasis web yang dibuat untuk membantu proses pendataan dan pengelolaan stok buku secara lebih mudah dan terorganisir. Aplikasi dibangun menggunakan PHP Native, MySQL, HTML, dan CSS dengan tampilan modern bernuansa pastel agar lebih nyaman digunakan.

## Identitas

**Nama:** Binti Nur Hamidah

**NIM:** 240631100075

## Tentang Aplikasi

Aplikasi ini digunakan untuk mengelola data buku dalam sebuah sistem sederhana. Pengguna dapat menambahkan data buku, melihat daftar buku, melakukan perubahan data, menghapus data, serta mencari buku berdasarkan kata kunci tertentu.

Selain itu, aplikasi juga dilengkapi dengan dashboard yang menampilkan informasi statistik seperti jumlah judul buku dan total stok buku yang tersedia.

## Fitur Utama

* Login dan logout pengguna
* Dashboard informasi buku
* Menampilkan daftar buku
* Menambahkan data buku
* Mengubah data buku
* Menghapus data buku
* Pencarian data buku
* Status stok buku (tersedia, terbatas, dan kosong)
* Tampilan responsive dan user friendly

## Tampilan Aplikasi

### Halaman Login

![Login](img/login.png)

### Dashboard

![Dashboard](img/dashboard.png)

### Daftar Buku

![Daftar Buku](img/daftar-buku.png)

### Tambah Buku

![Tambah Buku](img/tambah-buku.png)

### Edit Buku

![Edit Buku](img/edit-buku.png)

## Struktur Database

Database yang digunakan bernama **db_buku**.

### Tabel Buku

| Field        | Tipe Data    |
| ------------ | ------------ |
| id           | INT          |
| judul        | VARCHAR(255) |
| penulis      | VARCHAR(100) |
| penerbit     | VARCHAR(100) |
| tahun_terbit | INT          |
| kategori     | VARCHAR(50)  |
| stok         | INT          |

### Query Pembuatan Tabel

```sql
CREATE DATABASE db_buku;

USE db_buku;

CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit INT NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    stok INT NOT NULL
);
```

## Cara Menjalankan Aplikasi

1. Install XAMPP.
2. Jalankan Apache dan MySQL.
3. Simpan folder project ke dalam direktori `htdocs`.
4. Buat database `db_buku` melalui phpMyAdmin.
5. Import file database yang telah disediakan.
6. Pastikan konfigurasi database pada file `koneksi.php` sudah sesuai.
7. Jalankan aplikasi melalui browser dengan alamat:

```text
http://localhost/uas
```

8. Login menggunakan akun yang tersedia dan mulai mengelola data buku.

## Teknologi yang Digunakan

* PHP Native
* MySQL
* HTML5
* CSS3
* XAMPP
* Visual Studio Code

## Kesimpulan

Sistem Pendataan dan Manajemen Stok Buku Berbasis Web dibuat untuk mempermudah pengelolaan data buku secara digital. Dengan adanya fitur CRUD, pencarian data, dashboard statistik, serta sistem login pengguna, aplikasi ini dapat membantu proses pendataan buku menjadi lebih cepat, rapi, dan efisien.
