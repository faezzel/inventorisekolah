<?php
  include '../../config/database.php';
  $this_page = "itemin"; // active state
  include '../../includes/header.php';

  // Ambil data kategori
  $categoryQuery = $pdo->query("SELECT id_kategori, nama_kategori FROM kategori");
  $categories = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);

  // Ambil data supplier
  $supplierQuery = $pdo->query("SELECT id_pemasok, nama_pemasok FROM pemasok");
  $suppliers = $supplierQuery->fetchAll(PDO::FETCH_ASSOC);

  $id = $_GET['id'];
  $stmt = $pdo->prepare("SELECT * FROM barang_masuk JOIN pemasok ON barang_masuk.id_pemasok = pemasok.id_pemasok JOIN pengguna ON barang_masuk.id_pengguna = pengguna.id_pengguna JOIN kategori ON barang_masuk.id_kategori = kategori.id_kategori WHERE id_barang_masuk = ?");
  $stmt->execute([$id]);
  $barang_masuk = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $qty = $_POST['qty'];
    $item_location = $_POST['item_location'];
    $id_category = $_POST['id_category'];
    $id_supplier = $_POST['id_supplier'];

    if ($item_name == '' || $qty == '' || $item_location == '') {
      $error = 'Mohon isi semua input';
    } else {
      $stmt = $pdo->prepare("UPDATE barang_masuk SET nama_barang = ?, qty = ?, lokasi_barang = ?, id_kategori = ?, id_pemasok = ? WHERE id_barang_masuk = ?");
      $stmt->execute([$item_name, $qty, $item_location, $id_category, $id_supplier, $id]);
    }

    // Menampilkan alert dan redirect ke index
    echo "<script type='text/javascript'>alert('Barang masuk berhasil diubah'); window.location.href='index.php';</script>";
  }
?>
<div class="content flex-column">
    <h2 class="mb-8">Edit Barang Masuk</h2>
    <p class="small">Halaman untuk mengubah data barang masuk</p>
    <hr class="mt-20 mb-32">
    <form class="flex-column gap-16 w-50" action="edit.php?id=<?php echo $barang_masuk['id_barang_masuk']; ?>" method="post">
      <div class="flex-column gap-4">
        <label class="small" for="item_name">Nama Barang</label>
        <input type="text" id="item_name" name="item_name" value="<?php echo htmlspecialchars($barang_masuk['nama_barang']); ?>" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="qty">Qty</label>
        <input type="number" id="qty" name="qty" value="<?php echo htmlspecialchars($barang_masuk['qty']); ?>" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="item_location">Lokasi Barang</label>
        <input type="text" id="item_location" name="item_location" value="<?php echo htmlspecialchars($barang_masuk['lokasi_barang']); ?>" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="id_category">Kategori Barang</label>
        <select name="id_category" id="id_category" required>
          <option selected value="<?php echo htmlspecialchars($barang_masuk['id_kategori']); ?>"><?php echo htmlspecialchars($barang_masuk['nama_kategori']); ?></option>
          <?php foreach ($categories as $category): ?>
            <?php if($category['id_kategori'] != $barang_masuk['id_kategori']): ?>
            <option value="<?php echo $category['id_kategori']; ?>"><?php echo $category['nama_kategori']; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="id_supplier">Nama Pemasok</label>
        <select name="id_supplier" id="id_supplier" required>
          <option selected value="<?php echo htmlspecialchars($barang_masuk['id_pemasok']); ?>"><?php echo htmlspecialchars($barang_masuk['nama_pemasok']); ?></option>
          <?php foreach ($suppliers as $supplier): ?>
            <?php if($supplier['id_pemasok'] != $barang_masuk['id_pemasok']): ?>
            <option value="<?php echo $supplier['id_pemasok']; ?>"><?php echo $supplier['nama_pemasok']; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
      <button class="primary self-baseline" type="submit">Simpan</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>