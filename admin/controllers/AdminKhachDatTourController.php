<?php
class AdminKhachDatTourController {
    public $modelKhachDatTour;

    public function __construct() {
        // Khởi tạo Model
        $this->modelKhachDatTour = new AdminKhachDatTour();
    }

    /**
     * Hàm hiển thị danh sách khách
     */
    public function list() {
        // 1. Lấy dữ liệu từ Model
        $listKhach = $this->modelKhachDatTour->getAllKhachDatTour();

        // 2. Gọi file View để hiển thị
        // Lưu ý: Đường dẫn này tính từ file index.php gốc
        require_once './views/khach_dat_tour/list.php';
    }

    /**
     * Hàm xử lý xóa khách
     */
    public function delete() {
        // 1. Lấy id từ URL (ví dụ: ?act=xoa-khach&id_khach=5)
        // Sử dụng ?? null để tránh lỗi nếu không có tham số
        $id = $_GET['id_khach'] ?? null;

        // 2. Kiểm tra nếu có ID hợp lệ thì gọi Model xóa
        if ($id) {
            $this->modelKhachDatTour->deleteKhach($id);
        }

        // 3. Xóa xong (hoặc không có ID) thì quay về trang danh sách
        header("Location: " . BASE_URL_ADMIN . '?act=khach-dat-tour');
        exit();
    }
}
?>