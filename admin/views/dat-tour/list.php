<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

<div class="card">
  <div class="card-header bg-primary text-white">
    <h3 class="card-title">Danh Sách Đặt Tour</h3>
    <a href="?act=add-dat-tour" class="btn btn-success float-right">Thêm Mới</a>
  </div>

  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên Tour</th>
          <th>Hình Ảnh</th>
          <th>Ngày Đặt</th>
          <th>Trạng Thái</th>
          <th>Tổng Tiền</th>
          <th>Hành Trình</th>
          <th>Chính Sách</th>
          <th>Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($datTours as $dt): ?>
        <tr>
          <td><?= $dt['dat_tour_id'] ?></td>
          <td><?= htmlspecialchars($dt['ten_tour']) ?></td>
          
          <!-- Hiển thị hình ảnh -->
          <td>
            <img src="<?= $dt['hinh_anh'] ?>" alt="Hình ảnh tour" style="width: 100px; height: 70px; object-fit: cover;">
          </td>

          <td><?= $dt['ngay_dat'] ?></td>
          <td><?= $dt['dat_trang_thai'] ?></td>
          <td><?= number_format($dt['tong_tien'],0,',','.') ?> VNĐ</td>
          
          <!-- Hiển thị hành trình -->
          <td>
            <?= $dt['ngay_bat_dau'] ?> → <?= $dt['ngay_ket_thuc'] ?>
            (<?= number_format($dt['gia_mua'],0,',','.') ?> VNĐ)
          </td>

          <!-- Hiển thị chính sách -->
          <td>
            <?= htmlspecialchars($dt['chinh_sach']) ?>
          </td>

          <td>
            <a href="?act=edit-dat-tour&id=<?= $dt['dat_tour_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
            <a href="?act=delete-dat-tour&id=<?= $dt['dat_tour_id'] ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>

</div>
</section>
</div>

<?php include './views/layout/footer.php'; ?>
