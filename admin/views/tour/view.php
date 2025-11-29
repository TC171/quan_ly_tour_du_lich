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
          <h1>Chi Tiết Tour</h1>
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
        <div class="card-body row">
          <div class="col-md-4">
            <?php if (!empty($tour['hinh_anh'])): ?>
              <?php if (filter_var($tour['hinh_anh'], FILTER_VALIDATE_URL)): ?>
                <img src="<?= htmlspecialchars($tour['hinh_anh'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES) ?>" class="img-fluid" style="max-width: 100%; height: auto; border-radius: 5px;">
              <?php else: ?>
                <img src="./assets/img/tours/<?= htmlspecialchars($tour['hinh_anh'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES) ?>" class="img-fluid" style="max-width: 100%; height: auto; border-radius: 5px;">
              <?php endif; ?>
            <?php else: ?>
              <div class="text-muted text-center py-5">Chưa có ảnh</div>
            <?php endif; ?>
          </div>
          <div class="col-md-8">
            <h3><?= htmlspecialchars($tour['ten_tour'], ENT_QUOTES) ?></h3>
            <p><strong>Loại:</strong> <?= $tour['loai_tour'] ?></p>
            <p><strong>Giá:</strong> <?= number_format($tour['gia_tour'], 0, ',', '.') ?> VNĐ</p>
            <p><strong>Mô tả:</strong><br><?= nl2br(htmlspecialchars($tour['mo_ta'] ?? '', ENT_QUOTES)) ?></p>
            <p><strong>Chính sách:</strong><br><?= nl2br(htmlspecialchars($tour['chinh_sach'] ?? '', ENT_QUOTES)) ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include './views/layout/footer.php'; ?>
