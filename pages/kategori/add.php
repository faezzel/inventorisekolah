<?php
  include '../../config/database.php';
  $this_page = "category"; // active state
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }

  $error = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if ($name == '' || $description == '') {
      $error = 'Mohon isi semua input';
    } else {
      $stmt = $pdo->prepare("INSERT INTO kategori (nama_kategori, deskripsi) VALUES (:nama_kategori, :deskripsi)");
      $stmt->execute([
        'nama_kategori' => $name,
        'deskripsi' => $description
      ]);
    }

    // Menampilkan alert dan redirect ke index
    echo "<script type='text/javascript'>alert('Kategori barang berhasil di input'); window.location.href='index.php';</script>";
  }
?>
<div class="content flex-column">
    <h2 class="mb-8">Tambah Kategori</h2>
    <p class="small">Halaman untuk menambahkan data kategori barang</p>
    <hr class="mt-20 mb-32">
    <form class="flex-column gap-16 w-50" action="add.php" method="post">
      <div class="flex-column gap-4">
        <label class="small" for="name">Nama Kategori Barang</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="2" required></textarea>
      </div>
      <?php if ($error): ?>
        <p style="color: red;font-size: 12px;"><?php echo $error; ?></p>
      <?php endif; ?>
      <button class="primary self-baseline" type="submit">Simpan</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>