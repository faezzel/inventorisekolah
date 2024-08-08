<?php
  include '../../config/database.php';
  $this_page = "itemin"; // active state
  include '../../includes/header.php';

  $query = $pdo->query("SELECT * FROM barang_masuk JOIN pemasok ON barang_masuk.id_pemasok = pemasok.id_pemasok JOIN pengguna ON barang_masuk.id_pengguna = pengguna.id_pengguna JOIN kategori ON barang_masuk.id_kategori = kategori.id_kategori");
  $items_in = $query->fetchAll(PDO::FETCH_ASSOC);
  $no = 1;
?>
<div class="content flex-column">
    <h2 class="mb-8">Daftar Barang Masuk</h2>
    <p class="small">Kumpulan data barang masuk</p>
    <hr class="mt-20 mb-32">
    <a class="green self-baseline items-center gap-4" href="add.php">
      <img src="../../assets/images/icons/add.svg" alt="add icon">
      <span>Tambah Barang Masuk</span>
    </a>
    <table class="table-view mt-20">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Qty</th>
                <th>Pemasok</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items_in as $item_in): ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo htmlspecialchars($item_in['nama_barang']); ?></td>
                <td><?php echo htmlspecialchars($item_in['nama_kategori']); ?></td>
                <td><?php echo htmlspecialchars($item_in['qty']); ?></td>
                <td><?php echo htmlspecialchars($item_in['nama_pemasok']); ?></td>
                <td><?php echo htmlspecialchars($item_in['lokasi_barang']); ?></td>
                <td>
                    <a class="yellow btn-sm items-center gap-4" href="edit.php?id=<?php echo $item_in['id_barang_masuk']; ?>">
                        <img src="../../assets/images/icons/edit.svg" alt="edit icon">
                        <span>Edit</span>
                    </a>
                    <a class="red btn-sm items-center gap-4" href="delete.php?id=<?php echo $item_in['id_barang_masuk']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus barang masuk ini?');">
                        <img src="../../assets/images/icons/bin.svg" alt="delete icon">
                        <span>Hapus</span>
                    </a>
                    <a class="cyan btn-sm items-center gap-4" href="detail.php?id=<?php echo $item_in['id_barang_masuk']; ?>" title="Detail">
                        <img src="../../assets/images/icons/info.svg" alt="info icon">
                        <span>Detail</span>
                    </a>
                </td>
            </tr>
            <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>