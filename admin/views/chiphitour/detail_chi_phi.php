<?php 
// Biến $chiPhi được Controller truyền vào 
// Biến BASE_URL_ADMIN phải được định nghĩa trong env.php

include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/navbar.php';
include __DIR__ . '/../layout/sidebar.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Chi tiết Chi phí Tour</h1>
    </section>

    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Thông tin chi phí ID: <?= htmlspecialchars($chiPhi['chiphi_id'] ?? '') ?></h3>
            </div>
            <div class="card-body">
                <?php if (isset($chiPhi)): ?>
                <dl class="row">
                    <dt class="col-sm-4">Tour ID/Tên Tour:</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($chiPhi['tour_id'] ?? 'N/A') ?></dd>
                    
                    <dt class="col-sm-4">Loại Chi phí:</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($chiPhi['loai_chi_phi'] ?? 'N/A') ?></dd>
                    
                    <dt class="col-sm-4">Số Tiền:</dt>
                    <dd class="col-sm-8 text-bold"><?= number_format($chiPhi['so_tien'] ?? 0) ?> VNĐ</dd>
                    
                    <dt class="col-sm-4">Ngày Phát sinh:</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($chiPhi['ngay_phat_sinh'] ?? 'N/A') ?></dd>
                    
                    <dt class="col-sm-4">Ghi Chú:</dt>
                    <dd class="col-sm-8"><?= nl2br(htmlspecialchars($chiPhi['ghi_chu'] ?? 'Không có')) ?></dd>
                </dl>
                <?php else: ?>
                    <p class="text-danger">Không tìm thấy dữ liệu chi phí.</p>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <a href="<?= BASE_URL_ADMIN . '?act=chi_phi_tour' ?>" class="btn btn-default">
                    <i class="fas fa-arrow-left"></i> Quay lại Danh sách
                </a>
                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-chi-phi&id=' . ($chiPhi['chiphi_id'] ?? '') ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Chỉnh Sửa
                </a>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>