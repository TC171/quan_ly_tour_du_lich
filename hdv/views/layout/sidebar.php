<?php 
  // 1. Lấy đúng session từ AdminTaiKhoanController
  // Kiểm tra cả 'ho_ten' và 'ten_dang_nhap' đề phòng trường hợp thiếu dữ liệu
  $role = $_SESSION['admin']['vai_tro'] ?? ''; 
  $userName = $_SESSION['admin']['ho_ten'] ?? $_SESSION['admin']['ten_dang_nhap'] ?? 'HDV';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= BASE_URL_HDV ?>?act=hdv-dashboard" class="brand-link">
    <img src="../../assets/dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity:.8">
    <span class="brand-text font-weight-light">Portal HDV</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $userName ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <a href="<?= BASE_URL_HDV ?>?act=hdv-dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Tổng quan (Dashboard)</p>
          </a>
        </li>

        <?php if($role === 'HDV'): ?>

          <li class="nav-header">CÔNG VIỆC</li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>?act=lich-trinh-cua-toi" class="nav-link">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>Lịch Trình Của Tôi</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>?act=khach-lich-trinh" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Check-in Khách</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>?act=chi-phi-cua-toi" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>Quản Lý Chi Phí</p>
            </a>
          </li>

          <li class="nav-header">CÁ NHÂN</li>

          <li class="nav-item">
            <a href="<?= BASE_URL_HDV ?>?act=lich-su-hdv" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>Lịch Sử Dẫn Tour</p>
            </a>
          </li>

        <?php endif; ?>
        <li class="nav-item">
            <a href="../../index.php?act=logout-admin" class="nav-link text-danger" onclick="return confirm('Bạn chắc chắn muốn đăng xuất?')">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Đăng Xuất</p>
            </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>