<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header"><h1>Thêm Lịch Trình Mới</h1></section>
    <section class="content">
        <div class="card card-primary">
            <form action="?act=them-lich-trinh" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Chọn Tour (*)</label>
                        <select name="tour_id" class="form-control" required>
                            <?php foreach($tours as $t): ?>
                                <option value="<?= $t['tour_id'] ?>"><?= $t['ten_tour'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày thứ (*)</label>
                                <input type="number" name="ngay_thu" class="form-control" placeholder="VD: 1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thời gian</label>
                                <input type="text" name="thoi_gian" class="form-control" placeholder="VD: 08:00 - 11:00">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Điểm tham quan</label>
                        <input type="text" name="diem_tham_quan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Mô tả chi tiết</label>
                        <textarea name="mo_ta" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu Lịch Trình</button>
                    <a href="?act=hanh_trinh" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </section>
</div>
<?php include './views/layout/footer.php'; ?>