<?php
  include '../../config/database.php';
  $this_page = "users"; // active state
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }

  $query = $pdo->query("SELECT * FROM pengguna WHERE role='staff'");
  $users = $query->fetchAll(PDO::FETCH_ASSOC);
  $no=1;
?>
<div class="content flex-column">
    <h2 class="mb-8">Daftar Pengguna</h2>
    <p class="small">Kumpulan data pengguna</p>
    <hr class="mt-20 mb-32">
    <table class="table-view">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $pengguna): ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo htmlspecialchars($pengguna['username']); ?></td>
                <td><?php echo htmlspecialchars($pengguna['role']); ?></td>
                <td><?php echo htmlspecialchars($pengguna['email']); ?></td>
                <td>
                    <a class="red btn-sm items-center gap-4" href="delete.php?id=<?php echo $pengguna['id_pengguna']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengguna ini?');">
                        <img src="../../assets/images/icons/bin.svg" alt="delete icon">
                        <span>Hapus</span>
                    </a>
                </td>
            </tr>
            <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>