<?php
  include '../../config/database.php';
  $this_page = "category"; // active state
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }
  
  $id = $_GET['id'];
  $stmt = $pdo->prepare("SELECT * FROM kategori WHERE id_kategori = ?");
  $stmt->execute([$id]);
  $category = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE kategori SET nama_kategori = ?, deskripsi = ? WHERE id_kategori = ?");
    $stmt->execute([$name, $description, $id]);

    // Menampilkan alert dan redirect ke index
    echo "<script type='text/javascript'>alert('Kategori barang berhasil diubah'); window.location.href='index.php';</script>";
  }
?>
<div class="content flex-column">
  <h2 class="mb-8">Edit Kategori</h2>
  <p class="small">Halaman untuk mengubah data kategori barang</p>
  <hr class="mt-20 mb-32">
  <form class="flex-column gap-16 w-50" action="edit.php?id=<?php echo $category['id_kategori']; ?>" method="post">
    <div class="flex-column gap-4">
      <label class="small" for="name">Nama Kategori Barang</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['nama_kategori']); ?>" required>
    </div>
    <div class="flex-column gap-4">
      <label class="small" for="description">Deskripsi</label>
      <textarea id="description" name="description" rows="2" required><?php echo htmlspecialchars($category['deskripsi']); ?></textarea>
    </div>
      <button class="primary self-baseline" type="submit">Simpan</button>
  </form>
</div>
<?php include '../../includes/footer.php'; ?>