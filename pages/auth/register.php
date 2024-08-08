<?php
  session_start();
  require_once '../../config/database.php';

  // Fungsi untuk mengarahkan pengguna ke halaman tertentu
  function redirect($url) {
    header("Location: $url");
    exit();
  }

  // Periksa apakah pengguna sudah login
  if (isset($_SESSION['id_pengguna'])) {
    redirect('../../index.php');
  }

  $error = '';
  $success = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if ($username == '' || $password == '' || $confirm_password == '' || $email == '' || $role == '') {
        $error = 'Mohon isi semua input';
    } elseif ($password != $confirm_password) {
        $error = 'Passwords tidak cocok';
    } else {
      // Periksa apakah username sudah ada
      $stmt = $pdo->prepare("SELECT COUNT(*) FROM pengguna WHERE username = :username");
      $stmt->execute(['username' => $username]);
      if ($stmt->fetchColumn() > 0) {
        $error = 'Username sudah ada';
      } else {
        // Hash password dan simpan pengguna baru
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO pengguna (username, password, email, role) VALUES (:username, :password, :email, :role)");
        $stmt->execute([
            'username' => $username,
            'password' => $hashed_password,
            'email' => $email,
            'role' => $role
        ]);

        // Menampilkan alert
        echo "<script type='text/javascript'>alert('Registrasi berhasil! Anda bisa menggunakan tombol Login di bawah');</script>";
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Informasi Inventori Sekolah</title>
    <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: sans-serif;
    }
    body {
      background-color: whitesmoke;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .mb-8 { margin-bottom: 8px; }
    .mb-12 { margin-bottom: 12px; }
    .mb-16 { margin-bottom: 16px; }
    .mb-20 { margin-bottom: 20px; }
    .mb-32 { margin-bottom: 32px; }
    .gap-8 { gap: 8px; }
    .gap-12 { gap: 12px; }
    .gap-16 { gap: 16px; }
    .gap-20 { gap: 20px; }
    .text-center { text-align: center; }
    .flex-row {
      display: flex;
      flex-direction: row;
    }
    .flex-column {
      display: flex;
      flex-direction: column;
    }
    img.logo {
      display: block;
      margin-inline: auto;
      max-width: 160px;
      width: 100%;
      height: auto;
    }
    section {
      background-color: white;
      padding: 56px 40px;
      border-radius: 8px;
      box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }
    span.asterisk {
      font-size: 16px;
      color: #991b1b;
    }
    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
      padding: 8px;
      border: 1px solid #111111;
      border-radius: 4px;
    }
    input[type="submit"],
    button.primary {
      padding: 12px 14px;
      color: white;
      background-color: #0ea5e9;
      border: 1px solid #0ea5e9;
      border-radius: 4px;
      font-weight: 500;
      font-size: 14px;
      text-decoration: none;
    }
    input[type="reset"],
    button.default {
      padding: 12px 14px;
      color: #111111;
      background-color: whitesmoke;
      border: 1px solid #111111;
      border-radius: 4px;
      font-weight: 500;
      font-size: 14px;
      text-decoration: none;
    }
    input[type="submit"]:hover,
    button.primary:hover {
      background-color: #0284c7;
      border: 1px solid #0284c7;
      cursor: pointer;
    }
    input[type="reset"]:hover,
    button.default:hover {
      background-color: #e6e6e6;
      cursor: pointer;
    }
  </style>
</head>
<body>
    <section>
      <img class="logo mb-32" src="../../assets/images/unindra.png" alt="Logo Unindra">
      <h2 class="text-center mb-8">Register</h2>
      <h2 class="text-center mb-32">Sistem Informasi Inventori Sekolah</h2>
      <form action="register.php" method="post" class="flex-column gap-12">
          <div class="flex-column gap-8">
              <label for="username">Username<span class="asterisk">*</span></label>
              <input type="text" name="username" id="username" required>
          </div>
          <div class="flex-column gap-8">
              <label for="email">Email<span class="asterisk">*</span></label>
              <input type="email" name="email" id="email" required>
          </div>
          <div class="flex-column gap-8">
              <label for="role">Role<span class="asterisk">*</span></label>
              <select name="role" id="role" required>
                <option>--Pilih role--</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
              </select>
          </div>
          <div class="flex-column gap-8">
              <label for="password">Password<span class="asterisk">*</span></label>
              <input type="password" name="password" id="password" required>
          </div>
          <div class="flex-column gap-8">
              <label for="confirm_password">Confirm Password<span class="asterisk">*</span></label>
              <input type="password" name="confirm_password" id="confirm_password" required>
          </div>
          <div class="flex-row gap-8 mb-32">
            <button class="primary" type="submit">Register</button>
            <button class="default" type="reset">Reset</button>
          </div>
      </form>
      <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </section>
</body>
</html>