<div class="sidebar flex-column gap-16">
  <div class="flex-row gap-16 items-center">
    <img class="img-logo" src="../../assets/images/unindra.png" alt="Logo Unindra">
    <h3>Sistem Informasi Inventori Sekolah</h3>
  </div>
  <hr>
  <nav class="flex-column">
    <ul class="flex-column gap-8">
      <?php if ($role == "admin"): ?>
      <li>
        <a href="../dashboard/dashboard.php" class="items-center gap-16 <?php if($this_page=='dashboard'){ echo 'active'; } ?>">
          <img src="../../assets/images/icons/home.svg" alt="home icon">
          <span>Dashboard</span>
        </a>
      </li>
      <?php elseif ($role == "staff"): ?>
      <li>
      <a href="../dashboard/dashboard_staff.php" class="items-center gap-16 <?php if($this_page=='dashboardstaff'){ echo 'active'; } ?>">
          <img src="../../assets/images/icons/home.svg" alt="home icon">
          <span>Dashboard</span>
        </a>
      </li>
      <?php endif; ?>
      <li>
        <a href="../kategori/index.php" class="items-center gap-16 <?php if($this_page=='category'){ echo 'active'; } ?>">
          <img src="../../assets/images/icons/item-category.svg" alt="category icon">
          <span>Kategori Barang</span>
        </a>
      </li>
      <li>
        <a href="../barang_masuk/index.php" class="items-center gap-16 <?php if($this_page=='itemin'){ echo 'active'; } ?>">
          <img src="../../assets/images/icons/item-in.svg" alt="item in icon">
          <span>Barang Masuk</span>
        </a>
      </li>
      <li>
        <a href="../barang_keluar/index.php" class="items-center gap-16 <?php if($this_page=='itemout'){ echo 'active'; } ?>">
          <img src="../../assets/images/icons/item-out.svg" alt="item out icon">
          <span>Barang Keluar</span>
        </a>
      </li>
      <li>
        <a href="../pemasok/index.php" class="items-center gap-16 <?php if($this_page=='supplier'){ echo 'active'; } ?>">
          <img src="../../assets/images/icons/supplier.svg" alt="supplier icon">
          <span>Pemasok</span>
        </a>
      </li>
      <?php if ($role == "admin"): ?>
      <li>
        <a href="../pengguna/index.php" class="items-center gap-16 <?php if($this_page=='users'){ echo 'active'; } ?>">
          <img src="../../assets/images/icons/users.svg" alt="user icon">
          <span>Pengguna</span>
        </a>
      </li>
      <?php endif; ?>
      <li class="mt-auto">
        <ul class="flex-column gap-8">
          <li>
            <a href="../profil/index.php" class="items-center gap-16 <?php if($this_page=='profile'){ echo 'active'; } ?>">
              <img src="../../assets/images/icons/profile.svg" alt="profile icon">
              <span>
              <?php
                if (isset($_SESSION['id_pengguna'])) {
                  echo ucfirst($username).' ('.$role.')';
                } else {
                  echo 'Profile';
                }
              ?>
              </span>
            </a>
          </li>
          <li>
            <a href="../auth/logout.php" class="items-center gap-16">
              <img src="../../assets/images/icons/out.svg" alt="logout icon">
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>