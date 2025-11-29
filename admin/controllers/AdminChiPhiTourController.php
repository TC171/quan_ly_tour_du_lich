<?php
class AdminChiPhiTourController {
    public $modelChiPhi;

    public function __construct() {
        $this->modelChiPhi = new AdminChiPhiTour();
    }

    public function danhSachChiPhi() {
        // 1. Lấy dữ liệu từ Model
        $listChiPhi = $this->modelChiPhi->getAllChiPhi();

        // 2. Gọi View để hiển thị
        // Lưu ý: Đường dẫn này phải đúng với cấu trúc folder view của bạn
        require_once './views/chiphi/list_chi_phi.php';
    }
}
?>