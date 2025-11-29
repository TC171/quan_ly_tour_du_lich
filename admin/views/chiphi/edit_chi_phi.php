<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa Chi Phí Tour</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Thông tin chi phí</h3>
                </div>
                <form action="<?= BASE_URL_ADMIN . '?act=sua-chi-phi' ?>" method="POST">
                    <input type="hidden" name="chiphi_id" value="<?= $chiPhi['chiphi_id'] ?>">
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label>Chọn Tour</label>
                            <select class="form-control" name="tour_id">
                                <?php foreach ($listTour as $tour): ?>
                                    <option value="<?= $tour['tour_id'] ?>" 
                                        <?= $tour['tour_id'] == $chiPhi['tour_id'] ? 'selected' : '' ?>>
                                        <?= $tour['ten_tour'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Loại Chi Phí</label>
                            <select class="form-control" name="loai_chi_phi">
                                <option value="Khách sạn" <?= $chiPhi['loai_chi_phi'] == 'Khách sạn' ? 'selected' : '' ?>>Khách sạn</option>
                                <option value="Vận chuyển" <?= $chiPhi['loai_chi_phi'] == 'Vận chuyển' ? 'selected' : '' ?>>Vận chuyển</option>
                                <option value="Ăn uống" <?= $chiPhi['loai_chi_phi'] == 'Ăn uống' ? 'selected' : '' ?>>Ăn uống</option>
                                <option value="Khác" <?= $chiPhi['loai_chi_phi'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Số Tiền (VNĐ)</label>
                            <input type="number" class="form-control" name="so_tien" value="<?= $chiPhi['so_tien'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Ngày Phát Sinh</label>
                            <input type="date" class="form-control" name="ngay_phat_sinh" value="<?= $chiPhi['ngay_phat_sinh'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Ghi Chú</label>
                            <textarea class="form-control" name="ghi_chu" rows="3"><?= $chiPhi['ghi_chu'] ?></textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Cập Nhật</button>
                        <a href="<?= BASE_URL_ADMIN . '?act=chi_phi_tour' ?>" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>