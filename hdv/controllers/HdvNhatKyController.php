<?php
class HdvNhatKyController {
    public $model;

    public function __construct() {
        $this->model = new HdvNhatKy();
    }

    // Hàm hiển thị danh sách tour của tôi
    public function myTours() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) { header("Location: ?act=login"); exit(); }

        $user_id = $_SESSION['user']['user_id'];
        $hdvInfo = $this->model->getHdvInfo($user_id);

        if (!$hdvInfo) { echo "Tài khoản này chưa được cấp quyền HDV."; die(); }

        // Lấy danh sách tour
        $listTours = $this->model->getMyTours($hdvInfo['hdv_id']);
        
        // Gọi View trong folder hdv_chamcong
        require_once './views/hdv_chamcong/list_tours.php';
    }

    // Hàm hiển thị form chấm công
    public function chamCong() {
        if (!isset($_SESSION['user'])) { header("Location: ?act=login"); exit(); }

        $tour_id = $_GET['id'];
        $user_id = $_SESSION['user']['user_id'];
        $hdvInfo = $this->model->getHdvInfo($user_id);
        
        // Check bảo mật: Có phải tour của mình không?
        if (!$this->model->checkTourOwner($tour_id, $hdvInfo['hdv_id'])) {
            die("CẢNH BÁO: Bạn không có quyền truy cập tour này!");
        }

        $ngay = $_GET['ngay'] ?? date('Y-m-d');
        
        // Lấy dữ liệu cũ nếu đã từng check-in
        $nhatKy = $this->model->getNhatKy($tour_id, $hdvInfo['hdv_id'], $ngay);

        // Gọi View trong folder hdv_chamcong
        require_once './views/hdv_chamcong/form_checkin.php';
    }

    // Hàm xử lý khi bấm nút Gửi
    public function postChamCong() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user']['user_id'];
            $hdvInfo = $this->model->getHdvInfo($user_id);
            
            $tour_id = $_POST['tour_id'];
            // Check bảo mật lần nữa
            if (!$this->model->checkTourOwner($tour_id, $hdvInfo['hdv_id'])) {
                die("Lỗi bảo mật!");
            }

            $ngay = $_POST['ngay'];
            $ghi_chu = $_POST['ghi_chu'];
            
            // Xử lý upload ảnh
            $hinh_anh = '';
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['size'] > 0) {
                // Upload vào folder uploads/nhatky/
                $hinh_anh = uploadFile($_FILES['hinh_anh'], '/uploads/nhatky/');
            }

            $this->model->saveNhatKy($tour_id, $hdvInfo['hdv_id'], $ngay, $ghi_chu, $hinh_anh);
            
            // Chuyển hướng về lại trang form và thông báo
            echo "<script>alert('Đã gửi báo cáo thành công!'); window.location.href='?act=hdv-cham-cong&id=$tour_id&ngay=$ngay';</script>";
        }
    }
}
?>