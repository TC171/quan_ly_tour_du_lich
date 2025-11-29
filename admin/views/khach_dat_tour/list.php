<?php 
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/navbar.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách khách hàng trong Tour</h1>
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
                            <h3 class="card-title">Dữ liệu hành khách</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>Năm sinh</th>
                                        <th>Giới tính</th>
                                        <th>CMND/Passport</th>
                                        <th>Mã Booking</th>
                                        <th>Tên Tour</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($listKhach) && is_array($listKhach)): ?>
                                        <?php foreach ($listKhach as $key => $khach): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $khach['ho_ten'] ?? 'N/A' ?></td>
                                                
                                                <td><?= $khach['nam_sinh'] ?? '' ?></td>
                                                
                                                <td><?= $khach['gioi_tinh'] ?></td> 
                                                
                                                <td><?= $khach['cmnd_passport'] ?? '' ?></td>

                                                <td><?= $khach['booking_id'] ?? '' ?></td>
                                                <td><?= $khach['ten_tour'] ?? '' ?></td>
                                                <td>
                                                    <a href="?act=xoa-khach&id_khach=<?= $khach['khach_id'] ?>" 
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng: <?= $khach['ho_ten'] ?>?')" 
                                                       class="btn btn-danger btn-sm">
                                                       <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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

<?php require_once __DIR__ . '/../layout/footer.php'; ?>