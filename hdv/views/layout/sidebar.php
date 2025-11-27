<?php 
  $role = $_SESSION['user']['vai_tro'] ?? 'HDV'; 
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Logo -->
  <a href="<?= BASE_URL_HDV ?>" class="brand-link">
    <img src="./assets/dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity:.8">
    <span class="brand-text font-weight-light">Quản Trị Tours</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- User -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $_SESSION['user']['ho_ten'] ?? 'ADMIN' ?></a>
      </div>
    </div>

    <!-- Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
        <!-- TRANG CHỦ – tất cả đều xem được -->
        <li class="nav-item">
          <a href="<?= BASE_URL_HDV ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Trang chủ</p>
          </a>
        </li>


        <!-- ===================== HDV ONLY ========================= -->
        <?php if($role === 'HDV'): ?>

          <li class="nav-header">Hướng Dẫn Viên</li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>/lich-trinh-cua-toi" class="nav-link">
              <i class="nav-icon fas fa-route"></i>
              <p>Lịch Trình Của Tôi</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>/khach-lich-trinh" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Khách Trong Lịch Trình</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>/chi-phi-cua-toi" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>Chi Phí Tour (HDV)</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>/lich-su-hdv" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>Lịch Sử Tour Của Tôi</p>
            </a>
          </li>

        <?php endif; ?>
        <!-- =================== END HDV ONLY ======================== -->

      </ul>
    </nav>
  </div>
</aside>
