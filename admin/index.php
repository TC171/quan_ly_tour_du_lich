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

require_once './controllers/AdminChiPhiTourController.php'; // Controller Chi Phí


// Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminTour.php';
require_once './models/AdminDatTour.php';
require_once './models/AdminKhachDatTour.php';

require_once './models/AdminChiPhiTour.php'; // Model Chi Phí


// Router
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

    // --- QUẢN LÝ KHÁCH ĐẶT TOUR ---
    'khach-dat-tour' => (new AdminKhachDatTourController())->list(),
    'xoa-khach'      => (new AdminKhachDatTourController())->delete(), // <--- THÊM DÒNG NÀY
    
    // --- QUẢN LÝ CHI PHÍ TOUR ---
    'chi_phi_tour'      => (new AdminChiPhiTourController())->danhSachChiPhi(), // Xem danh sách
    'xoa-chi-phi'       => (new AdminChiPhiTourController())->delete(),         // Xóa
    'form-sua-chi-phi'  => (new AdminChiPhiTourController())->formEdit(),       // Hiển thị form sửa
    'sua-chi-phi'       => (new AdminChiPhiTourController())->postEdit(),       // Xử lý lưu sau khi sửa

    // Route auth  
    'login-admin'       => (new AdminTaiKhoanController())->formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),
    'logout-admin'      => (new AdminTaiKhoanController())->logout(),
};
?>