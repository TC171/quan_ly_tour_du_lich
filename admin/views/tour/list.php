<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">

  <!-- Header trang -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh Sách Tour</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Nội dung chính -->
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">Danh sách các tour đang có</h3>
        </div>

        <div class="card-body">

          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Tên Tour</th>
                <th>Loại Tour</th>
                <th>Giá Tour</th>
                <th>Số Ngày</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($tours as $tour): ?>
                <tr>
                  <td><?= $tour['tour_id'] ?></td>
                  <td><?= $tour['ten_tour'] ?></td>

                  <td>
                    <?= ucfirst(str_replace('_', ' ', $tour['loai_tour'])) ?>
                  </td>

                  <td><?= number_format($tour['gia_tour']) ?> VNĐ</td>

                  <td><?= $tour['so_ngay'] ?> ngày</td>

                  <td>
                    <?php if ($tour['trang_thai'] == 'dang_ban'): ?>
                      <span class="badge bg-success">Đang bán</span>
                    <?php else: ?>
                      <span class="badge bg-secondary">Tạm ngưng</span>
                    <?php endif; ?>
                  </td>

                  <td>
                    <a href="?act=edit-tour&id=<?= $tour['tour_id'] ?>" class="btn btn-warning btn-sm">
                      Sửa
                    </a>

                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa tour này?')"
                       href="?act=delete-tour&id=<?= $tour['tour_id'] ?>"
                       class="btn btn-danger btn-sm">
                      Xóa
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
