<?php
// URL base
define('BASE_URL_HDV', 'http://localhost/quan_ly_tour_du_lich/');
define('BASE_URL_ADMIN', 'http://localhost/quan_ly_tour_du_lich/admin/');

// Database config
define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'quan_ly_tour');
define('DB_CHARSET', 'utf8mb4'); // thêm charset

// Path config
define('PATH_ROOT', realpath(__DIR__ . '/..'));
define('PATH_UPLOADS', PATH_ROOT . '/uploads'); // thư mục upload files
define('PATH_VIEWS', PATH_ROOT . '/views');     // đường dẫn views

// Debug mode
define('DEBUG', true);
?>
