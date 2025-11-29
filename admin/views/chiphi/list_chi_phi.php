<?php include './views/layout/header.php'; ?> <?php include './views/layout/navbar.php'; ?> <?php include './views/layout/sidebar.php'; ?> <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản Lý Chi Phí Tour</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách chi phí phát sinh</h3>
                            <div class="card-tools">
                                <a href="<?= BASE_URL_ADMIN . '?act=form-them-chi-phi' ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Thêm chi phí mới
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Tour</th>
                                        <th>Loại Chi Phí</th>
                                        <th>Số Tiền</th>
                                        <th>Ngày Phát Sinh</th>
                                        <th>Ghi Chú</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php if (isset($listChiPhi) && is_array($listChiPhi)): ?>
        <?php foreach ($listChiPhi as $key => $chiPhi): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $chiPhi['ten_tour'] ?? 'Tour ID: '.$chiPhi['tour_id'] ?></td>
                <td><?= $chiPhi['loai_chi_phi'] ?></td>
                <td class="text-bold"><?= number_format($chiPhi['so_tien']) ?> VNĐ</td>
                <td><?= date("d-m-Y", strtotime($chiPhi['ngay_phat_sinh'])) ?></td>
                <td><?= $chiPhi['ghi_chu'] ?></td>
                <td>
                    <a href="<?= BASE_URL_ADMIN . '?act=form-sua-chi-phi&id=' . $chiPhi['chiphi_id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="<?= BASE_URL_ADMIN . '?act=xoa-chi-phi&id=' . $chiPhi['chiphi_id'] ?>" 
                       onclick="return confirm('Bạn có chắc chắn muốn xóa?')" 
                       class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="text-center text-danger">Không có dữ liệu hoặc lỗi kết nối CSDL!</td>
        </tr>
    <?php endif; ?>
</tbody>
                            </table>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?> ```

---

### Bước 4: Cập nhật Router (`index.php`)

Cuối cùng, khai báo Controller và Model mới vào file `index.php` để hệ thống hiểu được khi bấm vào link `?act=chi_phi_tour`.

Mở file `index.php` và thêm các dòng sau:

**1. Phần Require:**
```php
// ... Các require khác ...
require_once './models/AdminChiPhiTour.php'; // <--- Thêm dòng này
require_once './controllers/AdminChiPhiTourController.php'; // <--- Thêm dòng này