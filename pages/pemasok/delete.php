<?php
  include '../../config/database.php';
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }

  $id = $_GET['id'];
  $stmt = $pdo->prepare("DELETE FROM pemasok WHERE id_pemasok = ?");
  $stmt->execute([$id]);
  
  // Menampilkan alert dan redirect ke index
  echo "<script type='text/javascript'>alert('Data pemasok berhasil dihapus'); window.location.href='index.php';</script>";
?>