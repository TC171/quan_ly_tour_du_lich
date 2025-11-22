<?php
class AdminTaiKhoanController
{
    public $AdminTaiKhoan;

    public function __construct()
    {
        $this->AdminTaiKhoan = new AdminTaiKhoan();
    }

    // Hiển thị form login
    public function formLogin()
    {
        require_once './views/login.php';
    }

    // Xử lý đăng nhập
    public function login()
    {
        $ten_dang_nhap = $_POST['ten_dang_nhap'] ?? '';
        $mat_khau = $_POST['password'] ?? '';

        // Kiểm tra thông tin đăng nhập
        if (empty($ten_dang_nhap) || empty($mat_khau)) {
            $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
            header("Location: " . BASE_URL_ADMIN . "?act=login-admin");
            exit();
        }

        // Gọi model để lấy tài khoản
        $taiKhoan = (new AdminTaiKhoan())->getUserByUsername($ten_dang_nhap);

        // Kiểm tra tài khoản tồn tại
        if (!$taiKhoan) {
            $_SESSION['error'] = "Tên đăng nhập không tồn tại!";
            header("Location: " . BASE_URL_ADMIN . "?act=login-admin");
            exit();
        }

        // Kiểm tra mật khẩu
        if ($mat_khau !== $taiKhoan['mat_khau']) {
            $_SESSION['error'] = "Mật khẩu không chính xác!";
            header("Location: " . BASE_URL_ADMIN . "?act=login-admin");
            exit();
        }

        // Lưu thông tin người dùng vào session
        $_SESSION['admin'] = [
            'id' => $taiKhoan['nguoi_dung_id'],
            'ten_dang_nhap' => $taiKhoan['ten_dang_nhap'],
            'vai_tro' => $taiKhoan['vai_tro'] // Vai trò của người dùng (ADMIN, HDV, v.v.)
        ];

        // Sau khi lưu session
        if ($taiKhoan['vai_tro'] === 'HDV') {
            header("Location: " . BASE_URL_HDV );
        } elseif ($taiKhoan['vai_tro'] === 'ADMIN') {
            header("Location: " . BASE_URL_ADMIN );
        } else {
            $_SESSION['error'] = "Bạn không có quyền truy cập hệ thống!";
            header("Location: ?act=login-admin");
        }
        exit();
    }


    


    // Đăng xuất
    public function logout()
    {
        unset($_SESSION['admin']); // Xóa thông tin session của admin
        header("Location: ?act=login-admin"); // Chuyển hướng về trang login
        exit();
    }

    // Ví dụ trong controller
}
