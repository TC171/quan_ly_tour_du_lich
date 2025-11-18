<?php
session_start();
require_once "connect.php"; // file kết nối DB

$email = $_POST['email'];
$pass  = $_POST['password'];

$sql = "SELECT * FROM nguoi_dung WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user || !password_verify($pass, $user['mat_khau'])) {
    $_SESSION['error'] = "Email hoặc mật khẩu không đúng!";
    header("Location: login.php");
    exit;
}

// Lưu session
$_SESSION['user'] = [
    'id'     => $user['id'],
    'email'  => $user['email'],
    'ho_ten' => $user['ho_ten'],
    'vai_tro'=> $user['vai_tro'],
];

header("Location: admin/index.php");
exit;
