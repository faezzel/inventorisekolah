<?php
  include '../../config/database.php';
  $this_page = "category"; // active state
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }

  $query = $pdo->query("SELECT * FROM kategori");
  $categories = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="content flex-column">
    <h2 class="mb-8">Daftar Kategori</h2>
    <p class="small">Kumpulan data kategori barang</p>
    <hr class="mt-20 mb-32">
    <a class="green self-baseline items-center gap-4" href="add.php">
      <img src="../../assets/images/icons/add.svg" alt="add icon">
      <span>Tambah Kategori</span>
    </a>
    <table class="table-view mt-20">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo htmlspecialchars($category['id_kategori']); ?></td>
                <td><?php echo htmlspecialchars($category['nama_kategori']); ?></td>
                <td><?php echo htmlspecialchars($category['deskripsi']); ?></td>
                <td>
                    <a class="yellow btn-sm items-center gap-4" href="edit.php?id=<?php echo $category['id_kategori']; ?>">
                        <img src="../../assets/images/icons/edit.svg" alt="edit icon">
                        <span>Edit</span>
                    </a>
                    <a class="red btn-sm items-center gap-4" href="delete.php?id=<?php echo $category['id_kategori']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                        <img src="../../assets/images/icons/bin.svg" alt="delete icon">
                        <span>Hapus</span>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>