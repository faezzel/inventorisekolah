<?php
  include '../../config/database.php';
  $this_page = "itemin"; // active state
  include '../../includes/header.php';

  $barang_masuk = null;
  if (isset($_GET['id'])) {
      $id = $_GET['id'];
      try {
          $stmt = $pdo->prepare('SELECT * FROM barang_masuk JOIN pemasok ON barang_masuk.id_pemasok = pemasok.id_pemasok JOIN pengguna ON barang_masuk.id_pengguna = pengguna.id_pengguna JOIN kategori ON barang_masuk.id_kategori = kategori.id_kategori WHERE id_barang_masuk = ?');
          $stmt->execute([$id]);
          $barang_masuk = $stmt->fetch(PDO::FETCH_ASSOC);
          if (!$barang_masuk) {
              die("Barang masuk tidak ada.");
          }
      } catch (PDOException $e) {
          die("Tidak dapat mengambil data barang masuk: " . $e->getMessage());
      }
  } else {
      redirect('index.php');
  }
?>
<div class="content flex-column">
    <h2 class="mb-8">Detail Barang Masuk</h2>
    <p class="small">Detail data barang masuk</p>
    <hr class="mt-20 mb-32">
    <table class="table-view mt-20">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Pemasok</th>
                <th>Qty</th>
                <th>Lokasi</th>
                <th>Tipe Barang</th>
                <th>Waktu Input</th>
                <th>Operator</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($barang_masuk['id_barang_masuk']); ?></td>
                <td><?php echo htmlspecialchars($barang_masuk['nama_barang']); ?></td>
                <td><?php echo htmlspecialchars($barang_masuk['nama_kategori']); ?></td>
                <td><?php echo htmlspecialchars($barang_masuk['nama_pemasok']); ?></td>
                <td><?php echo htmlspecialchars($barang_masuk['qty']); ?></td>
                <td><?php echo htmlspecialchars($barang_masuk['lokasi_barang']); ?></td>
                <td><?php echo htmlspecialchars($barang_masuk['tipe_barang']); ?></td>
                <td><?php echo htmlspecialchars($barang_masuk['waktu_masuk']); ?></td>
                <td><?php echo ucfirst(htmlspecialchars($barang_masuk['username'])).' ('.htmlspecialchars($barang_masuk['role']).')' ; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>