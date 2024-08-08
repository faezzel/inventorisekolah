<?php
  include '../../config/database.php';
  $this_page = "itemout"; // active state
  include '../../includes/header.php';

  $query = $pdo->query("SELECT * FROM barang_keluar JOIN pengguna ON barang_keluar.id_pengguna = pengguna.id_pengguna JOIN kategori ON barang_keluar.id_kategori = kategori.id_kategori JOIN pemasok ON barang_keluar.id_pemasok = pemasok.id_pemasok");
  $items_out = $query->fetchAll(PDO::FETCH_ASSOC);
  $no = 1;
?>
<div class="content flex-column">
    <h2 class="mb-8">Daftar Barang Keluar</h2>
    <p class="small">Kumpulan data barang keluar</p>
    <hr class="mt-20 mb-32">
    <a class="green self-baseline items-center gap-4" href="add.php">
      <img src="../../assets/images/icons/add.svg" alt="add icon">
      <span>Tambah Barang Keluar</span>
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
            <?php foreach ($items_out as $item_out): ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo htmlspecialchars($item_out['nama_barang']); ?></td>
                <td><?php echo htmlspecialchars($item_out['nama_kategori']); ?></td>
                <td><?php echo htmlspecialchars($item_out['qty']); ?></td>
                <td><?php echo htmlspecialchars($item_out['nama_pemasok']); ?></td>
                <td><?php echo htmlspecialchars($item_out['lokasi_barang']); ?></td>
                <td>
                    <a class="yellow btn-sm items-center gap-4" href="edit.php?id=<?php echo $item_out['id_barang_keluar']; ?>">
                        <img src="../../assets/images/icons/edit.svg" alt="edit icon">
                        <span>Edit</span>
                    </a>
                    <a class="red btn-sm items-center gap-4" href="delete.php?id=<?php echo $item_out['id_barang_keluar']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus barang keluar ini?');">
                        <img src="../../assets/images/icons/bin.svg" alt="delete icon">
                        <span>Hapus</span>
                    </a>
                    <a class="cyan btn-sm items-center gap-4" href="detail.php?id=<?php echo $item_out['id_barang_keluar']; ?>" title="Detail">
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