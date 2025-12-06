<?php
class AdminNhatKyController {
    public $model;

    public function __construct() {
        // Khởi tạo Model
        $this->model = new AdminNhatKy();
    }

    public function danhSach() {
        // 1. Lấy tham số tìm kiếm từ URL (nếu có)
        // Dùng toán tử ?? '' để tránh lỗi nếu không có tham số
        $tour_id = $_GET['tour_id'] ?? ''; 
        $ngay    = $_GET['ngay'] ?? '';

        // 2. Gọi Model lấy danh sách nhật ký (Kết quả hiển thị ở bảng)
        // Truyền $tour_id và $ngay để Model lọc dữ liệu
        $listNhatKy = $this->model->getAll($tour_id, $ngay);

        // 3. Gọi Model lấy dữ liệu cho ô chọn (Dropdown)
        
        // Lấy danh sách tất cả các Tour có trong nhật ký
        $listTourFilter = $this->model->getDistinctTours(); 
        
        // Lấy danh sách Ngày (Nếu đã chọn Tour thì chỉ lấy ngày của Tour đó)
        $listDateFilter = $this->model->getDistinctDates($tour_id); 

        // 4. Gọi View để hiển thị giao diện
        require_once './views/nhatky/list.php';
    }
}
?>