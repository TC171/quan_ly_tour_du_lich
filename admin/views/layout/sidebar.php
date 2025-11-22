<?php 
  $role = $_SESSION['user']['vai_tro'] ?? 'ADMIN'; // Mặc định là Admin nếu không có vai trò
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Logo -->
  <a href="<?= BASE_URL_ADMIN ?>" class="brand-link">
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
          <a href="<?= BASE_URL_ADMIN ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Trang chủ</p>
          </a>
        </li>

        <!-- ===================== ADMIN ONLY ===================== -->
        <?php if($role === 'ADMIN'): ?>
          <li class="nav-header">QUẢN LÝ TOUR</li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN. '?act=list-tour'?>" class="nav-link">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>Danh sách Tour</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN. '?act=dat-tour' ?>" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Đặt Tour</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN. '?act=khach-dat-tour' ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Khách Đặt Tour</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/lich-trinh" class="nav-link">
              <i class="nav-icon fas fa-route"></i>
              <p>Lịch Trình Tour</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/khach-lich-trinh" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Khách trong Lịch Trình</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/khach-san" class="nav-link">
              <i class="nav-icon fas fa-hotel"></i>
              <p>Phân Phòng Khách Sạn</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/chi-phi" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>Chi Phí Tour</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/lich-su-tour" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>Lịch Sử Tour</p>
            </a>
          </li>

          <!-- NHÂN SỰ -->
          <li class="nav-header">NHÂN SỰ</li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/huong-dan-vien" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Hướng Dẫn Viên</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/nguoi-dung" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Người Dùng</p>
            </a>
          </li>

        <?php endif; ?>
        <!-- =================== END ADMIN ONLY ===================== -->

        <!-- ===================== HDV ONLY ========================= -->
        <?php if($role === 'HDV'): ?>

          <li class="nav-header">DÀNH CHO HƯỚNG DẪN VIÊN</li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/lich-trinh-cua-toi" class="nav-link">
              <i class="nav-icon fas fa-route"></i>
              <p>Lịch Trình Của Tôi</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/khach-lich-trinh" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Khách Trong Lịch Trình</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/chi-phi-cua-toi" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>Chi Phí Tour (HDV)</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>/lich-su-hdv" class="nav-link">
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
