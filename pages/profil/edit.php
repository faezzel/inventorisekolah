<?php
  include '../../config/database.php';
  $this_page = "profile"; // active state
  include '../../includes/header.php';

  // Ambil data pengguna dari database
  $user_id = $_SESSION['id_pengguna'];
  $query = $pdo->prepare("SELECT * FROM pengguna WHERE id_pengguna = :id_pengguna");
  $query->execute(['id_pengguna' => $user_id]);
  $user = $query->fetch(PDO::FETCH_ASSOC);

  if (!$user) {
    redirect('../auth/login.php');
  }

  // Proses penyimpanan data yang diubah
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $updateQuery = $pdo->prepare("UPDATE pengguna SET username = :username, email = :email WHERE id_pengguna = :id_pengguna");
    $updateQuery->execute([
        'username' => $username,
        'email' => $email,
        'id_pengguna' => $user_id
    ]);

    // Menampilkan alert dan redirect ke index
    echo "<script type='text/javascript'>alert('Data profil berhasil diubah'); window.location.href='index.php';</script>";
  }
?>
<div class="content flex-column">
    <h2 class="mb-8">Profil Pengguna</h2>
    <p class="small">Detail profil pengguna</p>
    <hr class="mt-20 mb-32">
    <form class="flex-column gap-16 w-50" action="edit.php?id=<?php echo $user['id_pengguna']; ?>" method="post">
      <div class="flex-column gap-4">
        <label class="small" for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
      </div>
      <button class="primary self-baseline" type="submit">Simpan</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>