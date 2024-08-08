<?php
session_start();

// Fungsi untuk mengarahkan pengguna ke halaman tertentu
function redirect($url) {
    header("Location: $url");
    exit();
}

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLoggedIn() {
    return isset($_SESSION['id_pengguna']);
}

// Fungsi untuk mendapatkan peran pengguna
function getUserRole() {
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
}

// Periksa apakah pengguna sudah login
if (!isLoggedIn()) {
    // Jika belum login, arahkan ke halaman login
    redirect('pages/auth/login.php');
} else {
    // Jika sudah login, arahkan ke halaman dashboard sesuai dengan peran
    $role = getUserRole();
    if ($role == 'admin') {
        redirect('pages/dashboard/dashboard.php');
    } elseif ($role == 'staff') {
        redirect('pages/dashboard/dashboard_staff.php'); // Misalnya ada dashboard khusus staff
    } else {
        // Jika peran tidak diketahui, arahkan ke halaman login
        redirect('pages/auth/login.php');
    }
}
?>