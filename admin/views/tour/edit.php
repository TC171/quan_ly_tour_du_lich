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
          <h1>Sửa Tour</h1>
        </div>
        <div class="col-sm-6 text-end">
          <a href="?act=tour" class="btn btn-secondary">Quay lại</a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="?act=edit-tour-save&id=<?= $tour['tour_id'] ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">Tên tour</label>
              <input type="text" name="ten_tour" value="<?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Loại tour</label>
              <select name="loai_tour" class="form-control">
                <option value="NOI_DIA" <?= $tour['loai_tour'] === 'NOI_DIA' ? 'selected' : '' ?>>Nội địa</option>
                <option value="QUOC_TE" <?= $tour['loai_tour'] === 'QUOC_TE' ? 'selected' : '' ?>>Quốc tế</option>
                <option value="THEO_YEU_CAU" <?= $tour['loai_tour'] === 'THEO_YEU_CAU' ? 'selected' : '' ?>>Theo yêu cầu</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Mô tả</label>
              <textarea name="mo_ta" class="form-control" rows="4"><?= htmlspecialchars($tour['mo_ta'] ?? '', ENT_QUOTES) ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Giá tour (VND)</label>
              <input type="number" name="gia_tour" value="<?= $tour['gia_tour'] ?>" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Ảnh đại diện (để trống nếu không đổi)</label>
              <div class="input-group mb-2">
                <input type="file" name="hinh_anh" class="form-control">
              </div>
              <div class="form-text">Hoặc nhập link ảnh mới:</div>
              <input type="url" name="hinh_anh_url" class="form-control mb-3" placeholder="https://example.com/image.jpg">
              <?php if (!empty($tour['hinh_anh'])): ?>
                <div class="mt-2">
                  <small class="text-muted">Ảnh hiện tại:</small>
                  <img src="./assets/img/tours/<?= htmlspecialchars($tour['hinh_anh'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES) ?>" style="max-width:200px; border-radius: 5px; display: block;">
                </div>
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label class="form-label">Chính sách</label>
              <textarea name="chinh_sach" class="form-control" rows="3"><?= htmlspecialchars($tour['chinh_sach'] ?? '', ENT_QUOTES) ?></textarea>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="trang_thai" id="trang_thai" <?= $tour['trang_thai'] ? 'checked' : '' ?>>
              <label class="form-check-label" for="trang_thai">Đang bán</label>
            </div>
            <button class="btn btn-primary">Cập nhật</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include './views/layout/footer.php'; ?>
