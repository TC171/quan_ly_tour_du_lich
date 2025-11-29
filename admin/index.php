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
require_once './controllers/AdminChiPhiTourController.php'; 


// Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminTour.php';
require_once './models/AdminDatTour.php'; 
require_once './models/AdminKhachDatTour.php';
require_once './models/AdminChiPhiTour.php'; 


// Router
$act = $_GET['act'] ?? '/';
// Kiểm tra đăng nhập (giữ nguyên logic của bạn)
if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin' ) {
    checkLogin();
}

// ----------------------------------------
// KHỞI TẠO CONTROLLER (CHỈ MỘT LẦN)
// ----------------------------------------
$controllerThongKe = new AdminBaoCaoThongKeController();
$controllerTaiKhoan = new AdminTaiKhoanController();
$controllerTour = new AdminTourController();
$controllerDatTour = new AdminDatTourController();
$controllerKhachDatTour = new AdminKhachDatTourController();
$controllerChiPhi = new AdminChiPhiTourController();


// Sử dụng match để điều hướng các request
match ($act) {
    // route báo cáo thống kê - trang chủ
    '/' => $controllerThongKe->home(),
    'tour' => $controllerTour->danhSachTour(),

    // --- QUẢN LÝ ĐẶT TOUR (BOOKING) ---
    'dat-tour' => $controllerDatTour->list(), 
    'xoa-booking' => $controllerDatTour->delete(), 
    'form-sua-booking' => $controllerDatTour->formEdit(), 
    'sua-booking' => $controllerDatTour->postEdit(), 

    // --- QUẢN LÝ KHÁCH ĐẶT TOUR (HÀNH KHÁCH) ---
    'khach-dat-tour' => $controllerKhachDatTour->list(),
    'xoa-khach' => $controllerKhachDatTour->delete(),
    'form-sua-khach' => $controllerKhachDatTour->formEdit(), 
    'sua-khach' => $controllerKhachDatTour->postEdit(), 
    
    // ------------------------------------
    // --- QUẢN LÝ CHI PHÍ TOUR (C R U D)---
    // ------------------------------------
    // READ:
    'chi_phi_tour' => $controllerChiPhi->danhSachChiPhi(), 
    'detail-chi-phi' => $controllerChiPhi->detailChiPhi(), 

    // CREATE:
    'form-them-chi-phi' => $controllerChiPhi->formAdd(), 
    'post-them-chi-phi' => $controllerChiPhi->postAdd(), 

    // UPDATE:
    'form-sua-chi-phi' => $controllerChiPhi->formEdit(), 
    'sua-chi-phi' => $controllerChiPhi->postEdit(), 

    // DELETE:
    'xoa-chi-phi' => $controllerChiPhi->delete(), 
    
    // Route auth  
    'login-admin' => $controllerTaiKhoan->formLogin(),
    'check-login-admin' => $controllerTaiKhoan->login(),
    'logout-admin' => $controllerTaiKhoan->logout(),

    // Xử lý các route chưa xác định hoặc không khớp
    default => $controllerThongKe->home(), 
};
?>