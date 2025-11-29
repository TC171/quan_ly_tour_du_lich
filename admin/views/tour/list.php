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
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      <!-- Phần thống kê -->
      <div class="row mb-4">
        <div class="col-md-3">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <div class="text-end">
                <h1 class="m-0"><?= $stats['tong_tour'] ?? 0 ?></h1>
              </div>
              <p class="mt-2 mb-0">Tổng số tour</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-success text-white">
            <div class="card-body">
              <div class="text-end">
                <h1 class="m-0"><?= $stats['tour_dang_ban'] ?? 0 ?></h1>
              </div>
              <p class="mt-2 mb-0">Tour đang bán</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card bg-warning text-white">
            <div class="card-body">
              <div class="text-end">
                <h1 class="m-0"><?= $stats['tour_tam_ngung'] ?? 0 ?></h1>
              </div>
              <p class="mt-2 mb-0">Tour tạm ngưng</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">Danh sách các tour đang có</h3>
        </div>
        <div style="padding: 15px 20px;">
          <a href="?act=add-tour" class="btn btn-success btn-sm" style="margin-left: 5px;">
            <i class="fas fa-plus"></i> Thêm Tour Mới
          </a>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th width="5%">ID</th>
                <th width="12%">Ảnh</th>
                <th width="20%">Tên Tour</th>
                <th width="12%">Loại Tour</th>
                <th width="15%">Giá Tour</th>
                <th width="10%">Ngày Tạo</th>
                <th width="10%">Trạng Thái</th>
                <th width="16%">Hành Động</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($tours)): ?>
                <?php foreach ($tours as $tour): ?>
                  <tr>
                    <td class="text-center"><strong><?= $tour['tour_id'] ?></strong></td>
                    <td class="text-center">
                      <?php if (!empty($tour['hinh_anh'])): ?>
                        <?php if (filter_var($tour['hinh_anh'], FILTER_VALIDATE_URL)): ?>
                          <img src="<?= htmlspecialchars($tour['hinh_anh'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES) ?>" style="max-width: 100px; height: 70px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                          <img src="./assets/img/tours/<?= htmlspecialchars($tour['hinh_anh'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES) ?>" style="max-width: 100px; height: 70px; object-fit: cover; border-radius: 4px;">
                        <?php endif; ?>
                      <?php else: ?>
                        <span class="badge bg-secondary">Không ảnh</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <strong><?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES, 'UTF-8') ?></strong>
                      <br>
                      <small class="text-muted"><?= htmlspecialchars(substr($tour['mo_ta'] ?? '', 0, 60), ENT_QUOTES, 'UTF-8') ?>...</small>
                    </td>
                    <td class="text-center">
                      <?php
                      $type_label = $tour['loai_tour'] === 'NOI_DIA' ? 'Nội địa' : ($tour['loai_tour'] === 'QUOC_TE' ? 'Quốc tế' : 'Theo yêu cầu');
                      $type_badge = $tour['loai_tour'] === 'NOI_DIA' ? 'bg-info' : ($tour['loai_tour'] === 'QUOC_TE' ? 'bg-danger' : 'bg-secondary');
                      ?>
                      <span class="badge <?= $type_badge ?>"><?= $type_label ?></span>
                    </td>
                    <td class="text-end">
                      <strong><?= number_format($tour['gia_tour'], 0, ',', '.') ?></strong>
                      <br>
                      <small class="text-muted">VNĐ</small>
                    </td>
                    <td class="text-center text-muted small">
                      <?= !empty($tour['ngay_tao']) ? date('d/m/Y', strtotime($tour['ngay_tao'])) : '-' ?>
                    </td>
                    <td class="text-center">
                      <?= $tour['trang_thai'] ? '<span class="badge bg-success"><i class="fas fa-check-circle"></i> Đang bán</span>' : '<span class="badge bg-warning text-dark"><i class="fas fa-pause-circle"></i> Tạm ngưng</span>' ?>
                    </td>
                    <td class="text-center">
                      <a href="?act=view-tour&id=<?= $tour['tour_id'] ?>" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Xem chi tiết">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="?act=edit-tour&id=<?= $tour['tour_id'] ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Sửa tour">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a onclick="return confirm('Bạn có chắc chắn muốn xóa tour này?')"
                        href="?act=delete-tour&id=<?= $tour['tour_id'] ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Xóa tour">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="text-center fst-italic text-muted py-4">
                    <i class="fas fa-inbox"></i> Chưa có tour nào
                  </td>
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
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>