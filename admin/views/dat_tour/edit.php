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
                    <h1>Cập nhật đơn hàng #<?= $booking['booking_id'] ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-booking' ?>" method="POST">
                        <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                        
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin chi tiết</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên Tour:</label>
                                            <input type="text" class="form-control" value="<?= $booking['ten_tour'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Ngày đặt:</label>
                                            <input type="text" class="form-control" value="<?= date('d/m/Y H:i', strtotime($booking['ngay_dat'])) ?>" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Người đặt:</label>
                                            <input type="text" class="form-control" value="<?= $booking['ten_nguoi_dat'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại:</label>
                                           <input type="text" class="form-control" 
       value="<?= $booking['sdt'] ?? $booking['so_dien_thoai'] ?? $booking['phone'] ?? '' ?>" 
       disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số lượng khách:</label>
                                            <input type="text" class="form-control" value="<?= $booking['so_nguoi'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tổng tiền:</label>
                                            <input type="text" class="form-control font-weight-bold text-danger" 
                                                   value="<?= number_format(($booking['gia_tour'] ?? 0) * ($booking['so_nguoi'] ?? 1)) ?> VNĐ" disabled>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="form-group">
                                    <label class="text-primary">Trạng thái đơn hàng:</label>
                                    <select name="trang_thai" class="form-control">
                                        <option value="0" <?= $booking['trang_thai'] == 0 ? 'selected' : '' ?>>Chờ xác nhận</option>
                                        <option value="1" <?= $booking['trang_thai'] == 1 ? 'selected' : '' ?>>Đã xác nhận</option>
                                        <option value="2" <?= $booking['trang_thai'] == 2 ? 'selected' : '' ?>>Đã hủy</option>
                                        <option value="3" <?= $booking['trang_thai'] == 3 ? 'selected' : '' ?>>Hoàn thành</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="<?= BASE_URL_ADMIN . '?act=dat-tour' ?>" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>