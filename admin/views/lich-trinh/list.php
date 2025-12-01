<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Quản Lý Lịch Trình Chi Tiết</h1></div>
                <div class="col-sm-6 text-right">
                    <a href="?act=form-them-lich-trinh" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm lịch trình</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tour</th>
                            <th>Ngày thứ</th>
                            <th>Điểm đến</th>
                            <th>Thời gian</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listLichTrinh as $lt): ?>
                        <tr>
                            <td><?= $lt['ten_tour'] ?></td>
                            <td class="text-center font-weight-bold"><?= $lt['ngay_thu'] ?></td>
                            <td><?= $lt['diem_tham_quan'] ?></td>
                            <td><?= $lt['thoi_gian'] ?></td>
                            <td><?= $lt['mo_ta'] ?></td>
                            <td>
                                <a href="?act=xoa-lich-trinh&id=<?= $lt['lichtrinh_id'] ?>" 
                                   class="btn btn-danger btn-sm" onclick="return confirm('Xóa dòng này?')">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include './views/layout/footer.php'; ?>