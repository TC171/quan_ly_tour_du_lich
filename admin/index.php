<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminTourController.php';
require_once './controllers/AdminDatTourController.php';
require_once './controllers/AdminKhachDatTourController.php';

require_once './controllers/AdminChiPhiTourController.php'; // <--- THÊM DÒNG NÀY (Để sửa lỗi Class not found)


// Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminTour.php';
require_once './models/AdminDatTour.php';
require_once './models/AdminKhachDatTour.php';

require_once './models/AdminChiPhiTour.php'; // <--- THÊM DÒNG NÀY (Để Controller dùng được Model)


//router
$act = $_GET['act'] ?? '/';
if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin' ) {
    checkLogin();
}

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    // route báo cáo thống kê - trang chủ
    '/' => (new AdminBaoCaoThongKeController())->home(),
    'tour' => (new AdminTourController())->danhSachTour(),

    // route đặt tour
    'dat-tour' => (new AdminDatTourController())->list(),

    //router khách đặt tour
    'khach-dat-tour' => (new AdminKhachDatTourController())->list(),
    
    // --- ROUTE CHI PHÍ TOUR MỚI THÊM ---
    'chi_phi_tour' => (new AdminChiPhiTourController())->danhSachChiPhi(), 
    // Lưu ý: Tên act 'chi_phi_tour' phải khớp với href trong sidebar.php (?act=chi_phi_tour)

    //Route auth  
    'login-admin' => (new AdminTaiKhoanController())-> formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),
    'logout-admin' => (new AdminTaiKhoanController())->logout(),
};
?>