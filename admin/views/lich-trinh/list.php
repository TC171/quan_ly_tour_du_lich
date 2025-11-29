<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <!-- Card -->
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Danh Sách Lịch Trình Tour</h3>
                    <a href="?act=add-lich-trinh" class="btn btn-success">Thêm Lịch Trình</a>
                </div>

                <div class="card-body">
                    <!-- Thông báo -->
                    <?php if (!empty($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
                    <?php endif; ?>

                    <!-- Filter tour -->
                    <form method="GET" class="mb-3 d-flex align-items-center">
                        <input type="hidden" name="act" value="lich-trinh">
                        <label class="me-2" style="margin-right: 5px;">Chọn Tour:</label>
                        <select name="tour_id" class="form-select me-2" style="width:auto;">
                            <option value="0">-- Tất cả --</option>
                            <?php foreach ($tours as $t): ?>
                                <option value="<?= $t['tour_id'] ?>" <?= (isset($tour_id) && $tour_id == $t['tour_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t['ten_tour']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-info" style="margin-left: 5px;">Lọc</button>
                    </form>

                    <!-- Table danh sách -->
                    <?php if (!empty($lists)): ?>
                        <table class="table table-bordered table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tour</th>
                                    <th>Ngày Thứ</th>
                                    <th>Điểm Tham Quan</th>
                                    <th>Thời Gian</th>
                                    <th>Mô Tả</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lists as $lt): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($lt['lichtrinh_id']) ?></td>
                                        <td><?= htmlspecialchars($lt['ten_tour']) ?></td>
                                        <td><?= htmlspecialchars($lt['ngay_thu']) ?></td>
                                        <td><?= htmlspecialchars($lt['diem_tham_quan']) ?></td>
                                        <td><?= htmlspecialchars($lt['thoi_gian']) ?></td>
                                        <td><?= htmlspecialchars($lt['mo_ta']) ?></td>
                                        <td>
                                            <a href="?act=edit-lich-trinh&id=<?= $lt['lichtrinh_id'] ?>" class="btn btn-warning btn-sm mb-1">Sửa</a>
                                            <a href="?act=delete-lich-trinh&id=<?= $lt['lichtrinh_id'] ?>" class="btn btn-danger btn-sm mb-1"
                                               onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center text-muted mt-3">Không có lịch trình nào.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
