<?php
if(isset($_SESSION['login'])){
    header("Location: index.php");
    exit();
}
session_start();
require "koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username == "admin" && $password == "midah123") {

        $_SESSION['login'] = true;
        $_SESSION['nama'] = "Hamidah";

        header("Location: index.php");
        exit();

    } else {

        $error = "Username atau password salah!";

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username == "midah" && $password == "midah123") {

        $_SESSION['login'] = true;
        $_SESSION['nama'] = "Midah";

        header("Location: index.php");
        exit();

    } else {

        $error = "Username atau password salah!";

    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pendataan Buku</title>

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


</head>
<body class="login-page">

<div class="login-wrapper">

    <div class="login-card">

        <div class="login-header">
            <h1>📚 Sistem Pendataan Buku</h1>
            <p>Silakan login untuk mengakses sistem</p>
        </div>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-warning">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>👤 Username</label>
            <input
                type="text"
                name="username"
                placeholder="Masukkan username"
                required
            >

            <label>🔒 Password</label>
            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit" class="btn-login">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>