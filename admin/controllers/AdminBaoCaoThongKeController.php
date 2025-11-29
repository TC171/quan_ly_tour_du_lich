<?php
// Nhớ require model ở đầu file hoặc trong index.php đã có rồi
require_once './models/AdminBaoCaoThongKe.php';

class AdminBaoCaoThongKeController {
    public $modelThongKe;

    public function __construct() {
        $this->modelThongKe = new AdminBaoCaoThongKe();
    }

    public function home() {
        // Lấy các thông số thống kê
        $tongTour = $this->modelThongKe->countTour();
        $tongDonHang = $this->modelThongKe->countDonDat();
        $tongKhachHang = $this->modelThongKe->countKhachHang();
        $tongDoanhThu = $this->modelThongKe->countDoanhThu();

        // Lấy dữ liệu cho biểu đồ (nếu cần)
        // $listDoanhThu = $this->modelThongKe->getDoanhThuLast7Days();

        // Gọi view
        require_once './views/home.php';
    }
}
?>