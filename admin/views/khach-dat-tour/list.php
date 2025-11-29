<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Danh Sách Khách Trong Đặt Tour</h3>
                    <a href="?act=add-khach-dat-tour" class="btn btn-success">Thêm Mới</a>
                </div>

                <div class="card-body table-responsive p-0">
                    <?php if (!empty($khachs)): ?>
                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên Khách</th>
                                <th>Số Điện Thoại</th>
                                <th>Email</th>
                                <th>Tên Tour</th>
                                <th>Ngày Đặt</th>
                                <th>Ghi Chú</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($khachs as $k): ?>
                            <tr>
                                <td><?= htmlspecialchars($k['khach_id']) ?></td>
                                <td><?= htmlspecialchars($k['ho_ten']) ?></td>
                                <td><?= htmlspecialchars($k['so_dien_thoai']) ?></td>
                                <td><?= htmlspecialchars($k['email']) ?></td>
                                <td><?= htmlspecialchars($k['ten_tour']) ?></td>
                                <td><?= date('d/m/Y', strtotime($k['ngay_dat'])) ?></td>
                                <td><?= htmlspecialchars($k['ghi_chu'] ?? '') ?></td>
                                <td>
                                    <a href="?act=edit-khach-dat-tour&id=<?= $k['khach_id'] ?>" 
                                       class="btn btn-warning btn-sm mb-1">Sửa</a>
                                    <a href="?act=delete-khach-dat-tour&id=<?= $k['khach_id'] ?>" 
                                       class="btn btn-danger btn-sm mb-1" 
                                       onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <p class="text-center text-muted mt-3">Chưa có khách nào trong đặt tour.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
