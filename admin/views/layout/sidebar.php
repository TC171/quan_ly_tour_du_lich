<?php
$role = $_SESSION['user']['vai_tro'] ?? 'ADMIN';
$userName = htmlspecialchars($_SESSION['user']['ho_ten'] ?? 'ADMIN', ENT_QUOTES, 'UTF-8');

// Lấy action hiện tại để highlight menu (giữ cho menu sáng khi đang chọn)
$currentAct = $_GET['act'] ?? '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= BASE_URL_ADMIN ?>" class="brand-link">
    <img src="<?= BASE_URL_ADMIN ?>assets/dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity:.8">
    <span class="brand-text font-weight-light">Quản Trị Tours</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= BASE_URL_ADMIN ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $userName ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN ?>" class="nav-link <?= $currentAct === '' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>Trang Chủ Dashboard</p>
          </a>
        </li>

        <?php if($role === 'ADMIN'): ?>

          <li class="nav-header">QUẢN LÝ TOUR</li>
          
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=tour" class="nav-link <?= $currentAct === 'tour' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>Danh sách Tour</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=hanh_trinh" class="nav-link <?= $currentAct === 'hanh_trinh' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-route"></i>
              <p>Danh sách Hành Trình</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=hanh_trinh_chi_tiet" class="nav-link <?= $currentAct === 'hanh_trinh_chi_tiet' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>Chi Tiết Hành Trình</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=phan_cong_hdv" class="nav-link <?= $currentAct === 'phan_cong_hdv' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Phân Công HDV</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=chi_phi_tour" class="nav-link <?= $currentAct === 'chi_phi_tour' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>Chi Phí Tour</p>
            </a>
          </li>

          <li class="nav-header">QUẢN LÝ BOOKING</li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=dat-tour" class="nav-link <?= ($currentAct === 'dat-tour' || $currentAct === 'xoa-booking') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Danh sách Đặt Tour</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=khach-dat-tour" class="nav-link <?= ($currentAct === 'khach-dat-tour' || $currentAct === 'xoa-khach') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Khách Trong Đặt Tour</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=khach_trong_hanh_trinh" class="nav-link <?= $currentAct === 'khach_trong_hanh_trinh' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Khách Trong Hành Trình</p>
            </a>
          </li>

          <li class="nav-header">NHÂN SỰ</li>
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=huong_dan_vien" class="nav-link <?= $currentAct === 'huong_dan_vien' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Danh sách Hướng Dẫn Viên</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=cham_cong_hdv" class="nav-link <?= $currentAct === 'cham_cong_hdv' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>Chấm Công HDV</p>
            </a>
          </li>

          <li class="nav-header">NGƯỜI DÙNG</li>
           <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>?act=nguoi_dung" class="nav-link <?= $currentAct === 'nguoi_dung' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Quản lý Admin / HDV</p>
            </a>
          </li>

        <?php endif; ?>
      </ul>
    </nav>
  </div>
</aside>