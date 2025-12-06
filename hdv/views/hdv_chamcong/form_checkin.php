<?php include './views/layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-clipboard-check"></i> Báo Cáo Công Việc</h4>
                </div>
                <div class="card-body p-4">
                    
                    <form action="?act=post-hdv-cham-cong" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="tour_id" value="<?= $tour_id ?>">
                        
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Ngày báo cáo:</label>
                            <input type="date" name="ngay" class="form-control form-control-lg" 
                                   value="<?= $ngay ?>" 
                                   onchange="window.location.href='?act=hdv-cham-cong&id=<?= $tour_id ?>&ngay='+this.value">
                        </div>

                        <?php if ($nhatKy): ?>
                            <div class="alert <?= ($nhatKy['trang_thai'] == 1) ? 'alert-success' : (($nhatKy['trang_thai'] == 2) ? 'alert-danger' : 'alert-warning') ?> mb-4 shadow-sm">
                                <strong>Trạng thái:</strong> 
                                <?php 
                                    if ($nhatKy['trang_thai'] == 1) echo '✅ ĐÃ DUYỆT (CÓ MẶT)';
                                    elseif ($nhatKy['trang_thai'] == 2) echo '❌ KHÔNG DUYỆT (VẮNG)';
                                    else echo '⏳ ĐANG CHỜ DUYỆT';
                                ?>
                            </div>
                            
                            <?php if (!empty($nhatKy['hinh_anh'])): ?>
                                <div class="text-center mb-4">
                                    <p class="font-weight-bold">Ảnh đã gửi:</p>
                                    <img src="<?= $nhatKy['hinh_anh'] ?>" class="img-fluid rounded border" style="max-height: 300px;">
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-secondary mb-4">
                                <i class="fas fa-info-circle"></i> Chưa có báo cáo cho ngày này.
                            </div>
                        <?php endif; ?>

                        <hr>

                        <h5 class="text-primary mb-3">Nội dung báo cáo mới</h5>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold"><i class="fas fa-camera"></i> Chụp ảnh check-in:</label>
                            <input type="file" name="hinh_anh" class="form-control-file border p-2 rounded bg-light">
                            <small class="text-muted">Chụp ảnh tại điểm tham quan để làm bằng chứng.</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold"><i class="fas fa-pen"></i> Ghi chú công việc:</label>
                            <textarea name="ghi_chu" class="form-control" rows="4" 
                                      placeholder="Mô tả tình hình đoàn khách, sự cố (nếu có)..."><?= $nhatKy['ghi_chu'] ?? '' ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="?act=hdv-tours" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                                <i class="fas fa-paper-plane"></i> GỬI BÁO CÁO
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include './views/layout/footer.php'; ?>