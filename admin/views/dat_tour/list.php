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
                    <h1>Quản lý Đặt Tour (Booking)</h1>
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
                            <h3 class="card-title">Danh sách đơn đặt tour</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Booking</th>
                                        <th>Tên Tour</th>
                                        <th>Thông tin người đặt</th>
                                        <th>Ngày đặt</th>
                                        <th>Số người</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($listDatTour) && is_array($listDatTour)): ?>
                                        <?php foreach ($listDatTour as $key => $booking): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><b>#<?= $booking['booking_id'] ?></b></td>
                                                <td><?= $booking['ten_tour'] ?? 'N/A' ?></td>
                                                <td>
                                                    <b><?= $booking['ten_nguoi_dat'] ?? 'N/A' ?></b><br>
                                                    <small>Email: <?= $booking['email'] ?? '' ?></small><br>
                                                    <small>SĐT: <?= $booking['dien_thoai'] ?? 'Chưa cập nhật' ?></small>
                                                </td>
                                                <td><?= date('d/m/Y H:i', strtotime($booking['ngay_dat'])) ?></td>
                                                <td><?= $booking['so_nguoi'] ?></td>
                                                <td>
                                                    <?php 
                                                        $gia_tour = $booking['gia_tour'] ?? 0;
                                                        $so_nguoi = $booking['so_nguoi'] ?? 1;
                                                        echo number_format($gia_tour * $so_nguoi, 0, ',', '.');
                                                    ?> VNĐ
                                                </td>
                                                <td>
                                                    <?php 
                                                        $status = $booking['trang_thai'];
                                                        // Lưu ý: Nếu DB lưu chữ 'DA_COC' thì logic hiển thị ở đây cần sửa lại theo chuỗi đó.
                                                        // Hiện tại code đang chạy theo logic số (0, 1, 2). 
                                                        // Nếu cập nhật thành công mà hiển thị sai màu thì báo mình nhé.
                                                        if ($status == 0) echo '<span class="badge badge-warning">Chờ xác nhận</span>';
                                                        elseif ($status == 1) echo '<span class="badge badge-success">Đã xác nhận</span>';
                                                        elseif ($status == 2) echo '<span class="badge badge-danger">Đã hủy</span>';
                                                        else echo '<span class="badge badge-secondary">'.$status.'</span>';
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="?act=form-sua-booking&id_booking=<?= $booking['booking_id'] ?>" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="?act=xoa-booking&id_booking=<?= $booking['booking_id'] ?>" 
                                                           onclick="return confirm('Xóa đơn này?')" 
                                                           class="btn btn-danger btn-sm">
                                                           <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
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