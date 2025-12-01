<?php
// Đường dẫn gốc
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/quan_ly_tour_du_lich/');
}

// Đường dẫn vào Admin (Phải thêm /admin/)
if (!defined('BASE_URL_ADMIN')) {
    define('BASE_URL_ADMIN', 'http://localhost/quan_ly_tour_du_lich/admin/');
}

// Đường dẫn vào HDV (Phải thêm /hdv/)
if (!defined('BASE_URL_HDV')) {
    define('BASE_URL_HDV', 'http://localhost/quan_ly_tour_du_lich/hdv/');
}

// Các thông tin DB giữ nguyên
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'quan_ly_tour');
}

if (!defined('PATH_ROOT')) {
    define('PATH_ROOT', __DIR__ . '/../');
}
?>