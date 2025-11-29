<?php
require_once './models/AdminBaoCaoThongKe.php';

class AdminBaoCaoThongKeController {
    public $modelThongKe;

    public function __construct() {
        $this->modelThongKe = new AdminBaoCaoThongKe();
    }

    public function home() {
        // 1. Số liệu tổng hợp (4 ô vuông)
        $tongTour = $this->modelThongKe->countTour();
        $tongDonHang = $this->modelThongKe->countDonDat();
        $tongKhachHang = $this->modelThongKe->countKhachHang();
        $tongDoanhThu = $this->modelThongKe->countDoanhThu();

        // 2. Dữ liệu Biểu đồ
        $chartDoanhThu = $this->modelThongKe->getDoanhThu7Ngay();
        $chartLoaiTour = $this->modelThongKe->getTyLeLoaiTour();

        // Gọi View
        require_once './views/home.php';
    }
}
?>