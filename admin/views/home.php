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
                        <div class="icon"><i class="fas fa-map-marked-alt"></i></div>
                        <a href="?act=tour" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $tongDonHang ?></h3>
                            <p>Đơn đặt tour</p>
                        </div>
                        <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                        <a href="?act=dat-tour" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $tongKhachHang ?></h3>
                            <p>Khách hàng</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-plus"></i></div>
                        <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= number_format($tongDoanhThu, 0, ',', '.') ?><sup style="font-size: 20px">đ</sup></h3>
                            <p>Doanh thu (Đã xác nhận)</p>
                        </div>
                        <div class="icon"><i class="fas fa-chart-pie"></i></div>
                        <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Doanh Thu 7 Ngày Gần Nhất</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Tỷ Lệ Các Loại Tour</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- 1. XỬ LÝ DỮ LIỆU CHO BIỂU ĐỒ CỘT (Doanh Thu) ---
    // Chuyển dữ liệu PHP sang Javascript
    var dataDoanhThu = <?= json_encode($chartDoanhThu) ?>;
    
    var labelsNgay = [];
    var dataTien = [];

    // Tách mảng dữ liệu
    dataDoanhThu.forEach(function(item) {
        labelsNgay.push(item.ngay);
        dataTien.push(item.doanh_thu);
    });

    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    new Chart(barChartCanvas, {
        type: 'bar', // Loại biểu đồ: Cột
        data: {
            labels: labelsNgay, // Trục ngang: Ngày
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: dataTien, // Trục dọc: Tiền
                backgroundColor: 'rgba(60, 141, 188, 0.9)',
                borderColor: 'rgba(60, 141, 188, 0.8)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // --- 2. XỬ LÝ DỮ LIỆU CHO BIỂU ĐỒ TRÒN (Loại Tour) ---
    var dataLoaiTour = <?= json_encode($chartLoaiTour) ?>;
    var labelsLoai = [];
    var dataSoLuong = [];

    dataLoaiTour.forEach(function(item) {
        labelsLoai.push(item.loai_tour);
        dataSoLuong.push(item.so_luong);
    });

    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    new Chart(pieChartCanvas, {
        type: 'pie', // Loại biểu đồ: Tròn
        data: {
            labels: labelsLoai,
            datasets: [{
                data: dataSoLuong,
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'], // Các màu sắc cho từng phần
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
        }
    });
</script>