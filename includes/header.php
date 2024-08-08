<?php
    session_start();

    // Fungsi untuk mengarahkan pengguna ke halaman tertentu
    function redirect($url) {
        header("Location: $url");
        exit();
    }

    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['id_pengguna'])) {
        redirect('../pages/auth/login.php');
    }

    // Ambil informasi pengguna dari sesi
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($role) ?> - Sistem Informasi Inventori Sekolah</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <?php include "navbar.php"; ?>