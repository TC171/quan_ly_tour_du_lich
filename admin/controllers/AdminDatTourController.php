<?php
class AdminDatTourController {
    public $modelDatTour;

    public function __construct() {
        // Khởi tạo Model
        $this->modelDatTour = new AdminDatTour();
    }

    /**
     * Hàm hiển thị danh sách (Hàm bị thiếu gây ra lỗi)
     */
    public function list() {
        // 1. Lấy dữ liệu từ Model
        $listDatTour = $this->modelDatTour->getAllBookings();
        
        // 2. Gọi View hiển thị
        // Sử dụng __DIR__ để đường dẫn chính xác tuyệt đối
        require_once __DIR__ . '/../views/dat_tour/list.php';
    }

    /**
     * Hàm xóa Booking
     */
    public function delete() {
        // Lấy ID từ URL
        $id = $_GET['id_booking'] ?? null;
        
        // Nếu có ID thì gọi Model xóa
        if ($id) {
            $this->modelDatTour->deleteBooking($id);
        }
        
        // Xóa xong quay về danh sách
        header("Location: " . BASE_URL_ADMIN . '?act=dat-tour');
        exit();
    }
}
?>