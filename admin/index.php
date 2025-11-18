<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers

require_once './controllers/AdminBaoCaoThongKeController.php';


// Require toàn bộ file Models

//router
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // route báo cáo thống kê - trang chủ
    '/' => (new AdminBaoCaoThongKeController())->home(),
};