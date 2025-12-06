<?php 
session_start();

// 1. Require file Common
require_once './commons/env.php'; 
require_once './commons/function.php'; 

// 2. Require toàn bộ Controllers
require_once './controllers/HomeController.php';
require_once './controllers/HdvNhatKyController.php';
require_once './controllers/TaiKhoanController.php'; // <--- CẦN THÊM FILE NÀY (Để xử lý đăng nhập)

// 3. Require toàn bộ Models
require_once './models/HdvNhatKy.php';
require_once './models/TaiKhoan.php'; // <--- CẦN THÊM MODEL TÀI KHOẢN
require_once './models/Tour.php';     // <--- CẦN THÊM (Nếu HomeController dùng để hiện tour)

// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    // --- TRANG CHỦ ---
    '/' => (new HomeController())->home(),

    // --- CHỨC NĂNG TÀI KHOẢN (Đăng nhập/Đăng xuất cho HDV) ---
    // Bạn cần tạo thêm TaiKhoanController để xử lý cái này
    // 'login'       => (new TaiKhoanController())->formLogin(),
    // 'check-login' => (new TaiKhoanController())->login(),
    // 'logout'      => (new TaiKhoanController())->logout(),

    // --- MODULE HDV (CHẤM CÔNG) ---
    'hdv-tours'          => (new HdvNhatKyController())->myTours(),
    'hdv-cham-cong'      => (new HdvNhatKyController())->chamCong(),
    'post-hdv-cham-cong' => (new HdvNhatKyController())->postChamCong(),
};
?>