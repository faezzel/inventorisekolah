    <?php
        $this_page = "dashboard"; // active state
        include "../../includes/header.php";
        include "../../config/database.php";
        $query = $pdo->query("SELECT * FROM kategori");
        $query1 = $pdo->query("SELECT * FROM pemasok");
        $query2 = $pdo->query("SELECT * FROM pengguna");
        $query3 = $pdo->query("SELECT * FROM barang_masuk");
        $query4 = $pdo->query("SELECT * FROM barang_keluar");
        $category_rowcount = $query->rowCount();
        $supplier_rowcount = $query1->rowCount();
        $users_rowcount = $query2->rowCount();
        $itemin_rowcount = $query3->rowCount();
        $itemout_rowcount = $query4->rowCount();
    ?>
    <div class="content flex-column">
        <h2 class="mb-8">Dashboard</h2>
        <p class="small">Selamat datang di Sistem Informasi Inventori Sekolah</p>
        <hr class="mt-20 mb-32">
        <div class="flex-row w-100 gap-16">
            <div class="card">
                <p>Jumlah Kategori Barang</p>
                <h1><?php echo $category_rowcount; ?></h1>
            </div>
            <div class="card">
                <p>Jumlah Barang Masuk</p>
                <h1><?php echo $itemin_rowcount; ?></h1>
            </div>
            <div class="card">
                <p>Jumlah Barang Keluar</p>
                <h1><?php echo $itemout_rowcount; ?></h1>
            </div>
            <div class="card">
                <p>Jumlah Pemasok</p>
                <h1><?php echo $supplier_rowcount; ?></h1>
            </div>
            <?php if ($role == "admin"): ?>
            <div class="card">
                <p>Jumlah Pengguna</p>
                <h1><?php echo $users_rowcount; ?></h1>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include "../../includes/footer.php"; ?>