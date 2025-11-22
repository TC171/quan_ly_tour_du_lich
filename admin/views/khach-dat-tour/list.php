<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

<div class="card">
  <div class="card-header bg-primary text-white">
    <h3 class="card-title">Danh Sách Khách Trong Đặt Tour</h3>
    <a href="?act=add-khach-dat-tour" class="btn btn-success float-right">Thêm Mới</a>
  </div>

  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên Khách</th>
          <th>Số Điện Thoại</th>
          <th>Email</th>
          <th>Tên Tour</th>
          <th>Ngày Đặt</th>
          <th>Ghi Chú</th>
          <th>Hành Động</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($khachs as $k): ?>
        <tr>
          <td><?= $k['khach_id'] ?></td>
          <td><?= $k['ho_ten'] ?></td>
          <td><?= $k['so_dien_thoai'] ?></td>
          <td><?= $k['email'] ?></td>
          <td><?= $k['ten_tour'] ?></td>
          <td><?= $k['ngay_dat'] ?></td>
          <td><?= $k['ghi_chu'] ?></td>
          <td>
            <a href="?act=edit-khach-dat-tour&id=<?= $k['khach_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
            <a href="?act=delete-khach-dat-tour&id=<?= $k['khach_id'] ?>" class="btn btn-danger btn-sm"
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
