<?php 
session_start();

// 1. Require các file cấu hình chung
require_once '../commons/env.php';
require_once '../commons/function.php';

// 2. Require toàn bộ file Controllers
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminTourController.php';
require_once './controllers/AdminDatTourController.php'; 
require_once './controllers/AdminKhachDatTourController.php';
require_once './controllers/AdminChiPhiTourController.php'; 
require_once './controllers/AdminPhanBoController.php';      // <-- Quan trọng
require_once './controllers/AdminLichTrinhController.php';   

// 3. Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminTour.php';
require_once './models/AdminDatTour.php'; 
require_once './models/AdminKhachDatTour.php';
require_once './models/AdminChiPhiTour.php'; 
require_once './models/AdminPhanBo.php';          // <-- Quan trọng
require_once './models/AdminLichTrinhTour.php';   

// 4. Lấy hành động (act) từ URL
$act = $_GET['act'] ?? '/';

// 5. Kiểm tra đăng nhập
if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin' ) {
    checkLogin();
}

// ----------------------------------------
// 6. KHỞI TẠO CONTROLLER
// ----------------------------------------
$controllerThongKe    = new AdminBaoCaoThongKeController();
$controllerTaiKhoan   = new AdminTaiKhoanController();
$controllerTour       = new AdminTourController();
$controllerDatTour    = new AdminDatTourController();
$controllerKhach      = new AdminKhachDatTourController();
$controllerChiPhi     = new AdminChiPhiTourController();
$controllerPhanBo     = new AdminPhanBoController();      // <-- Quan trọng
$controllerLichTrinh  = new AdminLichTrinhController();

// ----------------------------------------
// 7. ĐIỀU HƯỚNG (ROUTING)
// ----------------------------------------
match ($act) {
    // --- DASHBOARD ---
    '/'                 => $controllerThongKe->home(),
    
    // --- AUTH ---
    'login-admin'       => $controllerTaiKhoan->formLogin(),
    'check-login-admin' => $controllerTaiKhoan->login(),
    'logout-admin'      => $controllerTaiKhoan->logout(),

    // --- QUẢN LÝ TOUR ---
    'tour'              => $controllerTour->danhSachTour(),
    'add-tour'          => $controllerTour->formAddTour(), 
    'post-add-tour'     => $controllerTour->postAddTour(), 
    'form-sua-tour'     => $controllerTour->formEditTour(), 
    'sua-tour'          => $controllerTour->postEditTour(), 
    'xoa-tour'          => $controllerTour->deleteTour(), 

    // --- QUẢN LÝ LỊCH TRÌNH ---
    'hanh_trinh'           => $controllerLichTrinh->index(),     
    'form-them-lich-trinh' => $controllerLichTrinh->formAdd(),   
    'them-lich-trinh'      => $controllerLichTrinh->postAdd(),   
    'xoa-lich-trinh'       => $controllerLichTrinh->delete(),    

    // --- QUẢN LÝ BOOKING ---
    'dat-tour'          => $controllerDatTour->list(), 
    'xoa-booking'       => $controllerDatTour->delete(), 
    'form-sua-booking'  => $controllerDatTour->formEdit(), 
    'sua-booking'       => $controllerDatTour->postEdit(), 

    // --- QUẢN LÝ KHÁCH HÀNG ---
    'khach-dat-tour'    => $controllerKhach->list(),
    'xoa-khach'         => $controllerKhach->delete(),
    'form-sua-khach'    => $controllerKhach->formEdit(), 
    'sua-khach'         => $controllerKhach->postEdit(), 
    
    // --- QUẢN LÝ CHI PHÍ ---
    'chi_phi_tour'      => $controllerChiPhi->danhSachChiPhi(), 
    'detail-chi-phi'    => $controllerChiPhi->detailChiPhi(), 
    'form-them-chi-phi' => $controllerChiPhi->formAdd(), 
    'postAdd'           => $controllerChiPhi->postAdd(), 
    'post-them-chi-phi' => $controllerChiPhi->postAdd(), 
    'form-sua-chi-phi'  => $controllerChiPhi->formEdit(), 
    'sua-chi-phi'       => $controllerChiPhi->postEdit(), 
    'xoa-chi-phi'       => $controllerChiPhi->delete(), 

    // --- QUẢN LÝ PHÂN BỔ HDV (Đây là đoạn bạn đang thiếu) ---
    'phan-bo-tour'      => $controllerPhanBo->danhSach(),
    'form-them-phan-bo' => $controllerPhanBo->formAdd(),
    'them-phan-bo'      => $controllerPhanBo->postAdd(),
    'xoa-phan-bo'       => $controllerPhanBo->delete(),

    // Mặc định
    default             => $controllerThongKe->home(), 
};
?>