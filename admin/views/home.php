<?php 
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/layout/navbar.php';
require_once __DIR__ . '/layout/sidebar.php';
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Báo Cáo Thống Kê</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $tongTour ?></h3>
                            <p>Tổng số Tour</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <a href="?act=tour" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $tongDonHang ?></h3>
                            <p>Đơn đặt tour</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="?act=dat-tour" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $tongKhachHang ?></h3>
                            <p>Khách hàng thành viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= number_format($tongDoanhThu, 0, ',', '.') ?><sup style="font-size: 20px">đ</sup></h3>
                            <p>Tổng doanh thu (Đã xác nhận)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê nhanh</h3>
                        </div>
                        <div class="card-body">
                            <p>Hệ thống đang hoạt động ổn định.</p>
                            <ul>
                                <li>Tổng số tour đang quản lý: <b><?= $tongTour ?></b></li>
                                <li>Tổng số booking nhận được: <b><?= $tongDonHang ?></b></li>
                                <li>Doanh thu ước tính: <b><?= number_format($tongDoanhThu, 0, ',', '.') ?> VNĐ</b></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div></section>
    </div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>