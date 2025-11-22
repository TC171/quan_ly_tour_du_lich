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
          <th>Ngày Đặt</th>
          <th>Trạng Thái</th>
          <th>Tổng Tiền</th>
          <th>Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($datTours as $dt): ?>
        <tr>
          <td><?= $dt['dat_tour_id'] ?></td>
          <td><?= $dt['ten_tour'] ?></td>
          <td><?= $dt['ngay_dat'] ?></td>
          <td><?= $dt['trang_thai'] ?></td>
          <td><?= number_format($dt['tong_tien'],0,',','.') ?> VNĐ</td>
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
