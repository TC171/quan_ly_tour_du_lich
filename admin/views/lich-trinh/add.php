<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Thêm Lịch Trình</h3>
                </div>

                <div class="card-body">
                    
                    <form method="POST" action="?act=add-lich-trinh">
                        <div class="mb-3">
                            <label>Chọn Tour</label>
                            <select name="tour_id" class="form-control" required>
                                <option value="">-- Chọn Tour --</option>
                                <?php foreach ($tours as $tourItem): ?>
                                    <option value="<?= htmlspecialchars($tourItem['tour_id']) ?>"
                                        <?= (isset($_POST['tour_id']) && $_POST['tour_id'] == $tourItem['tour_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($tourItem['ten_tour']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Ngày thứ</label>
                            <input type="number" name="ngay_thu" class="form-control" min="1"
                                   value="<?= htmlspecialchars($_POST['ngay_thu'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Điểm tham quan</label>
                            <input type="text" name="diem_tham_quan" class="form-control"
                                   value="<?= htmlspecialchars($_POST['diem_tham_quan'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Thời gian</label>
                            <input type="text" name="thoi_gian" class="form-control"
                                   value="<?= htmlspecialchars($_POST['thoi_gian'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label>Nội dung</label>
                            <textarea name="mo_ta" class="form-control" rows="3"><?= htmlspecialchars($_POST['mo_ta'] ?? '') ?></textarea>
                        </div>

                        <div class="text-end">
                            <a href="?act=lich-trinh&tour_id=<?= htmlspecialchars($_POST['tour_id'] ?? 0) ?>" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-success">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
