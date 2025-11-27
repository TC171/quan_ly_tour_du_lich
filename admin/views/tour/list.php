<?php 
include './views/layout/header.php'; 
include './views/layout/navbar.php'; 
include './views/layout/sidebar.php'; 
?>

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh Sách Tour</h1>
        </div>
        <div class="col-sm-6 text-end">
          <a href="?act=add-tour" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm Tour
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">Danh sách các tour đang có</h3>
        </div>

        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Tên Tour</th>
                <th>Loại Tour</th>
                <th>Mô Tả</th>
                <th>Giá Tour</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
              </tr>
            </thead>

            <tbody>
              <?php if(!empty($tours)): ?>
                <?php foreach ($tours as $tour): ?>
                  <tr>
                    <td><?= $tour['tour_id'] ?></td>
                    <td><?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= $tour['loai_tour'] === 'NOI_DIA' ? 'Nội địa' : ($tour['loai_tour'] === 'QUOC_TE' ? 'Quốc tế' : 'Theo yêu cầu') ?></td>
                    <td><?= !empty($tour['mo_ta']) ? htmlspecialchars($tour['mo_ta'], ENT_QUOTES, 'UTF-8') : '<span class="text-muted fst-italic">Chưa có mô tả</span>' ?></td>
                    <td><?= number_format($tour['gia_tour'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                      <?= $tour['trang_thai'] ? '<span class="badge bg-success">Đang bán</span>' : '<span class="badge bg-secondary">Tạm ngưng</span>' ?>
                    </td>
                    <td>
                      <!-- Xem chi tiết: chuyển đến trang show với các bảng liên quan -->
                      <a href="?act=view-tour&id=<?= $tour['tour_id'] ?>" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Xem chi tiết">
                        <i class="fas fa-eye"></i>
                      </a>
                      <!-- Sửa tour -->
                      <a href="?act=edit-tour&id=<?= $tour['tour_id'] ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Sửa tour">
                        <i class="fas fa-edit"></i>
                      </a>
                      <!-- Xóa tour -->
                      <a onclick="return confirm('Bạn có chắc chắn muốn xóa tour này?')" 
                         href="?act=delete-tour&id=<?= $tour['tour_id'] ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Xóa tour">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center fst-italic">Chưa có tour nào</td>
                </tr>
              <?php endif; ?>
            </tbody>

          </table>
        </div>
      </div>

    </div>
  </section>
</div>

<?php include './views/layout/footer.php'; ?>

<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>
