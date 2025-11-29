<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminTourController.php';
require_once './controllers/AdminDatTourController.php'; // Controller Đặt Tour
require_once './controllers/AdminKhachDatTourController.php';

require_once './controllers/AdminChiPhiTourController.php'; // Controller Chi Phí


// Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminTour.php';
require_once './models/AdminDatTour.php'; // Model Đặt Tour
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

    // --- QUẢN LÝ ĐẶT TOUR (BOOKING) ---
    'dat-tour'    => (new AdminDatTourController())->list(),   // Xem danh sách
    'xoa-booking' => (new AdminDatTourController())->delete(), // <--- THÊM DÒNG NÀY (Xóa Booking)

    // --- QUẢN LÝ KHÁCH ĐẶT TOUR (HÀNH KHÁCH) ---
    'khach-dat-tour' => (new AdminKhachDatTourController())->list(),
    'xoa-khach'      => (new AdminKhachDatTourController())->delete(),
    
    // --- QUẢN LÝ CHI PHÍ TOUR ---
    'chi_phi_tour'      => (new AdminChiPhiTourController())->danhSachChiPhi(), 
    'xoa-chi-phi'       => (new AdminChiPhiTourController())->delete(),         
    'form-sua-chi-phi'  => (new AdminChiPhiTourController())->formEdit(),       
    'sua-chi-phi'       => (new AdminChiPhiTourController())->postEdit(),       

    // Route auth  
    'login-admin'       => (new AdminTaiKhoanController())->formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),
    'logout-admin'      => (new AdminTaiKhoanController())->logout(),
};
?>