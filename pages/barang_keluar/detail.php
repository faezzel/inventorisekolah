<?php
  include '../../config/database.php';
  $this_page = "itemout"; // active state
  include '../../includes/header.php';

  $barang_keluar = null;
  if (isset($_GET['id'])) {
      $id = $_GET['id'];
      try {
          $stmt = $pdo->prepare('SELECT * FROM barang_keluar JOIN pemasok ON barang_keluar.id_pemasok = pemasok.id_pemasok JOIN pengguna ON barang_keluar.id_pengguna = pengguna.id_pengguna JOIN kategori ON barang_keluar.id_kategori = kategori.id_kategori WHERE id_barang_keluar = ?');
          $stmt->execute([$id]);
          $barang_keluar = $stmt->fetch(PDO::FETCH_ASSOC);
          if (!$barang_keluar) {
              die("Barang keluar tidak ada.");
          }
      } catch (PDOException $e) {
          die("Tidak dapat mengambil data barang keluar: " . $e->getMessage());
      }
  } else {
      redirect('index.php');
  }
?>
<div class="content flex-column">
    <h2 class="mb-8">Detail Barang Keluar</h2>
    <p class="small">Detail data barang keluar</p>
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
                <td><?php echo htmlspecialchars($barang_keluar['id_barang_keluar']); ?></td>
                <td><?php echo htmlspecialchars($barang_keluar['nama_barang']); ?></td>
                <td><?php echo htmlspecialchars($barang_keluar['nama_kategori']); ?></td>
                <td><?php echo htmlspecialchars($barang_keluar['nama_pemasok']); ?></td>
                <td><?php echo htmlspecialchars($barang_keluar['qty']); ?></td>
                <td><?php echo htmlspecialchars($barang_keluar['lokasi_barang']); ?></td>
                <td><?php echo htmlspecialchars($barang_keluar['tipe_barang']); ?></td>
                <td><?php echo htmlspecialchars($barang_keluar['waktu_keluar']); ?></td>
                <td><?php echo ucfirst(htmlspecialchars($barang_keluar['username'])).' ('.htmlspecialchars($barang_keluar['role']).')' ; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>