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
?>
<div class="content flex-column">
    <h2 class="mb-8">Profil Pengguna</h2>
    <p class="small">Detail profil pengguna</p>
    <hr class="mt-20 mb-32">
    <div id="data-profile" class="flex-column gap-16">
      <div class="flex-column gap-4">
        <p class="small bold">Username</p>
        <p><?php echo htmlspecialchars($user['username']); ?></p>
      </div>
      <div class="flex-column gap-4">
        <p class="small bold">Role</p>
        <p><?php echo htmlspecialchars($user['role']); ?></p>
      </div>
      <div class="flex-column gap-4">
        <p class="small bold">Email</p>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
      </div>
      <a class="yellow self-baseline" href="edit.php?id=<?php echo $user['id_pengguna']; ?>">Edit</a>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>