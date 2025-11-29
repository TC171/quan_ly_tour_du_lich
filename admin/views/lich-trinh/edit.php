<?php
include './views/layout/header.php';
include './views/layout/navbar.php';
include './views/layout/sidebar.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1 class="mb-3">Sửa Lịch Trình</h1>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="?act=edit-lich-trinh&id=<?= htmlspecialchars($lt['lichtrinh_id'] ?? 0) ?>">
          <input type="hidden" name="tour_id" value="<?= htmlspecialchars($lt['tour_id'] ?? 0) ?>">

          <div class="mb-3">
            <label class="form-label">Ngày thứ</label>
            <input type="number" name="ngay_thu" class="form-control" value="<?= htmlspecialchars($lt['ngay_thu'] ?? '') ?>" min="1" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Điểm tham quan</label>
            <input type="text" name="diem_tham_quan" class="form-control" value="<?= htmlspecialchars($lt['diem_tham_quan'] ?? '') ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Thời gian</label>
            <input type="text" name="thoi_gian" class="form-control" value="<?= htmlspecialchars($lt['thoi_gian'] ?? '') ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="mo_ta" class="form-control" rows="3"><?= htmlspecialchars($lt['mo_ta'] ?? '') ?></textarea>
          </div>

          <button type="submit" class="btn btn-success">Cập nhật</button>
          <a href="?act=lich-trinh&tour_id=<?= htmlspecialchars($lt['tour_id'] ?? 0) ?>" class="btn btn-secondary">Hủy</a>
        </form>
      </div>
    </div>
  </section>
</div>

<?php include './views/layout/footer.php'; ?>
