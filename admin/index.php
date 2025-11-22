<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers

require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminTourController.php';



// Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminTour.php';

//router
$act = $_GET['act'] ?? '/';
if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin' ) {
    checkLogin();
}


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // route báo cáo thống kê - trang chủ
    '/' => (new AdminBaoCaoThongKeController())->home(),
    'list-tour' => (new AdminTourController())->danhSachTour(),
    
    

    //Route auth  
    'login-admin' => (new AdminTaiKhoanController())-> formLogin(),
    'check-login-admin' => (new AdminTaiKhoanController())->login(),
    'logout-admin' => (new AdminTaiKhoanController())->logout(),


};