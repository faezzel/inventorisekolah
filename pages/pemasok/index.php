<?php
  include '../../config/database.php';
  $this_page = "supplier"; // active state
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }

  $query = $pdo->query("SELECT * FROM pemasok");
  $suppliers = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="content flex-column">
    <h2 class="mb-8">Daftar Pemasok</h2>
    <p class="small">Kumpulan data pemasok barang</p>
    <hr class="mt-20 mb-32">
    <a class="green self-baseline items-center gap-4" href="add.php">
        <img src="../../assets/images/icons/add.svg" alt="add icon">
        <span>Tambah Pemasok</span>
    </a>
    <table class="table-view mt-20">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?php echo htmlspecialchars($supplier['id_pemasok']); ?></td>
                <td><?php echo htmlspecialchars($supplier['nama_pemasok']); ?></td>
                <td><?php echo htmlspecialchars($supplier['kontak_pemasok']); ?></td>
                <td><?php echo htmlspecialchars($supplier['alamat_pemasok']); ?></td>
                <td>
                    <a class="yellow btn-sm items-center gap-4" href="edit.php?id=<?php echo $supplier['id_pemasok']; ?>">
                        <img src="../../assets/images/icons/edit.svg" alt="edit icon">
                        <span>Edit</span>
                    </a>
                    <a class="red btn-sm items-center gap-4" href="delete.php?id=<?php echo $supplier['id_pemasok']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data pemasok ini?');">
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