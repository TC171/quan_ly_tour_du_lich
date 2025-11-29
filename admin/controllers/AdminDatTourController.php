<?php
class AdminDatTourController {
    public $modelDatTour;

    public function __construct() {
        $this->modelDatTour = new AdminDatTour();
    }

    // 1. Danh sách
    public function list() {
        $listDatTour = $this->modelDatTour->getAllBookings();
        require_once __DIR__ . '/../views/dat_tour/list.php';
    }

    // 2. Xóa
    public function delete() {
        $id = $_GET['id_booking'] ?? null;
        if ($id) {
            $this->modelDatTour->deleteBooking($id);
        }
        header("Location: " . BASE_URL_ADMIN . '?act=dat-tour');
        exit();
    }

    // 3. Form Sửa
    public function formEdit() {
        $id = $_GET['id_booking'] ?? null;
        if ($id) {
            $booking = $this->modelDatTour->getDetailBooking($id);
            if ($booking) {
                require_once __DIR__ . '/../views/dat_tour/edit.php';
            } else {
                // Không tìm thấy dữ liệu -> về trang danh sách
                header("Location: " . BASE_URL_ADMIN . '?act=dat-tour');
                exit();
            }
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=dat-tour');
            exit();
        }
    }

    // 4. Xử lý Cập nhật (Sạch sẽ, không debug)
    public function postEdit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['booking_id'] ?? null;
            $trang_thai = $_POST['trang_thai'] ?? null;

            // Chỉ gọi model khi có đủ ID và Trạng thái
            if ($id && $trang_thai !== null) {
                $this->modelDatTour->updateBooking($id, $trang_thai);
            }
            
            // Xong việc thì quay về danh sách
            header("Location: " . BASE_URL_ADMIN . '?act=dat-tour');
            exit();
        }
    }
}
?>