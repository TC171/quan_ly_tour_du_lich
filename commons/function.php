<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
// thêm file
function uploadFile($file, $folderUpload){
    $pathStorage = $folderUpload . time() . $file['name'];
    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;
    if(move_uploaded_file($from, $to)){
        return $pathStorage;
    }
    return null;
}
//xóa file
function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;
    if(file_exists( $pathDelete )) {
        unlink( $pathDelete );
    }
}
// xóa session sau khi load trang
function deleteSessionError(){
    if (isset($_SESSION['flash'])) {
        unset($_SESSION['flash']);
        session_unset();
        // session_destroy();
    }
}
//upload + update album ảnh
function uploadFileAlbum($file, $folderUpload , $key){
    $pathStorage = $folderUpload . time() . $file['name'][$key];
    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;
    if(move_uploaded_file($from, $to)){
        return $pathStorage;
    }
    return null;
}
// format date 
function formatDate($date) {
    echo $newDate = date('d-m-Y', strtotime($date));
}




//
function checkLogin()
    {
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['admin'])) {
        header("Location: " . BASE_URL_ADMIN . "?act=login-admin"); // Nếu chưa đăng nhập, chuyển hướng đến trang login
        exit();
    }
}

function formatPrice($price){
    return number_format($price ,0,',','.');
}

function checkRole($allowedRoles = [])
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: ?act=login-admin");
            exit();
        }

        // Lấy vai trò từ session
        $role = $_SESSION['admin']['vai_tro'];

        // Kiểm tra quyền không đủ
        if (!in_array($role, $allowedRoles)) {
            $_SESSION['error'] = "Bạn không có quyền truy cập trang này!";
            header("Location: ?act=403");
            exit();
        }
    }