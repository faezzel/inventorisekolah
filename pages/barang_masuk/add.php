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

  // Ambil data pengguna
  $userQuery = $pdo->query("SELECT id_pengguna, username, role FROM pengguna WHERE id_pengguna = $_SESSION[id_pengguna]");
  $users = $userQuery->fetchAll(PDO::FETCH_ASSOC);

  $error = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $qty = $_POST['qty'];
    $item_location = $_POST['item_location'];
    $id_category = $_POST['id_category'];
    $id_supplier = $_POST['id_supplier'];
    $id_user = $_POST['id_user'];

    if ($item_name == '' || $qty == '' || $item_location == '') {
      $error = 'Mohon isi semua input';
    } else {
      $stmt = $pdo->prepare("INSERT INTO barang_masuk (nama_barang, qty, lokasi_barang, id_kategori, id_pemasok, id_pengguna) VALUES (:nama_barang, :qty, :lokasi_barang, :id_kategori, :id_pemasok, :id_pengguna)");
      $stmt->execute([
        'nama_barang' => $item_name,
        'qty' => $qty,
        'lokasi_barang' => $item_location,
        'id_kategori' => $id_category,
        'id_pemasok' => $id_supplier,
        'id_pengguna' => $id_user
      ]);
    }

    // Menampilkan alert dan redirect ke index
    echo "<script type='text/javascript'>alert('Barang masuk berhasil di input'); window.location.href='index.php';</script>";
  }
?>
<div class="content flex-column">
    <h2 class="mb-8">Tambah Barang Masuk</h2>
    <p class="small">Halaman untuk menambahkan data barang masuk</p>
    <hr class="mt-20 mb-32">
    <form class="flex-column gap-16 w-50" action="add.php" method="post">
      <div class="flex-column gap-4">
        <label class="small" for="item_name">Nama Barang</label>
        <input type="text" id="item_name" name="item_name" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="qty">Qty</label>
        <input type="number" id="qty" name="qty" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="item_location">Lokasi Barang</label>
        <input type="text" id="item_location" name="item_location" required>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="id_category">Kategori Barang</label>
        <select name="id_category" id="id_category" required>
          <option>--Pilih Kategori Barang--</option>
          <?php foreach ($categories as $category): ?>
          <option value="<?php echo $category['id_kategori']; ?>"><?php echo $category['nama_kategori']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="id_supplier">Nama Pemasok</label>
        <select name="id_supplier" id="id_supplier" required>
          <option>--Pilih Pemasok--</option>
          <?php foreach ($suppliers as $supplier): ?>
          <option value="<?php echo $supplier['id_pemasok']; ?>"><?php echo $supplier['nama_pemasok']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="flex-column gap-4">
        <label class="small" for="id_user">Operator</label>
        <select name="id_user" id="id_user" required>
          <?php foreach ($users as $user_id): ?>
          <option value="<?php echo $user_id['id_pengguna']; ?>"><?php echo ucfirst($user_id['username']).' ('.$user_id['role'].')'; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <?php if ($error): ?>
        <p style="color: red;font-size: 12px;"><?php echo $error; ?></p>
      <?php endif; ?>
      <button class="primary self-baseline" type="submit">Simpan</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>