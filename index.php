<?php
require_once "commons/env.php";
require_once "commons/function.php";

// Lấy controller & action từ URL
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Xử lý route
$file = "controllers/" . ucfirst($controller) . "Controller.php";
if (file_exists($file)) {
    require_once $file;
    $className = ucfirst($controller) . "Controller";
    $instance = new $className();
    if (method_exists($instance, $action)) {
        $instance->$action();
    } else {
        echo "❌ Action không tồn tại.";
    }
} else {
    echo "❌ Controller không tồn tại.";
}
