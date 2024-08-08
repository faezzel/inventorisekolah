<?php
  include '../../config/database.php';
  $this_page = "supplier"; // active state
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }

  $error = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    if ($name == '' || $contact == '' || $address == '') {
      $error = 'Mohon isi semua input';
    } else {
      $stmt = $pdo->prepare("INSERT INTO pemasok (nama_pemasok, kontak_pemasok, alamat_pemasok) VALUES (:nama_pemasok, :kontak_pemasok, :alamat_pemasok)");
      $stmt->execute([
        'nama_pemasok' => $name,
        'kontak_pemasok' => $contact,
        'alamat_pemasok' => $address
      ]);
    }

    // Menampilkan alert dan redirect ke index
    echo "<script type='text/javascript'>alert('Pemasok berhasil di input'); window.location.href='index.php';</script>";
  }
?>
<div class="content flex-column">
    <h2 class="mb-8">Tambah Pemasok</h2>
    <p class="small">Halaman untuk menambahkan data kategori barang</p>
    <hr class="mt-20 mb-32">
    <form class="flex-column gap-16 w-50" action="add.php" method="post">
      <div class="flex-column gap-4">
        <label class="small" for="name">Nama Pemasok</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="contact">Kontak</label>
        <input type="tel" id="contact" name="contact" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="address">Alamat</label>
        <textarea id="address" name="address" rows="2" required></textarea>
      </div>
      <?php if ($error): ?>
        <p style="color: red;font-size: 12px;"><?php echo $error; ?></p>
      <?php endif; ?>
      <button class="primary self-baseline" type="submit">Simpan</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>