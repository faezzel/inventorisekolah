<?php
  include '../../config/database.php';
  $this_page = "supplier"; // active state
  include '../../includes/header.php';

  // Periksa apakah pengguna sudah login dan memiliki peran yang sesuai
  if (!isset($_SESSION['id_pengguna'])) {
    redirect('../auth/login.php');
  }
  
  $id = $_GET['id'];
  $stmt = $pdo->prepare("SELECT * FROM pemasok WHERE id_pemasok = ?");
  $stmt->execute([$id]);
  $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("UPDATE pemasok SET nama_pemasok = ?, kontak_pemasok = ?, alamat_pemasok = ? WHERE id_pemasok = ?");
    $stmt->execute([$name, $contact, $address, $id]);

    // Menampilkan alert dan redirect ke index
    echo "<script type='text/javascript'>alert('Data pemasok berhasil diubah'); window.location.href='index.php';</script>";
  }
?>
<div class="content flex-column">
  <h2 class="mb-8">Edit Pemasok</h2>
  <p class="small">Halaman untuk mengubah data pemasok (supplier)</p>
  <hr class="mt-20 mb-32">
  <form class="flex-column gap-16 w-50" action="edit.php?id=<?php echo $supplier['id_pemasok']; ?>" method="post">
    <div class="flex-column gap-4">
      <label class="small" for="name">Nama Pemasok</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($supplier['nama_pemasok']); ?>" required>
    </div>
    <div class="flex-column gap-4">
      <label class="small" for="contact">Kontak</label>
      <input type="tel" id="contact" name="contact" value="<?php echo htmlspecialchars($supplier['kontak_pemasok']); ?>" required>
    </div>
    <div class="flex-column gap-4">
      <label class="small" for="address">Deskripsi</label>
      <textarea id="address" name="address" rows="2" required><?php echo htmlspecialchars($supplier['alamat_pemasok']); ?></textarea>
    </div>
    <button class="primary self-baseline" type="submit">Simpan</button>
  </form>
</div>
<?php include '../../includes/footer.php'; ?>