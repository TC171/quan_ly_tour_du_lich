<?php
class AdminNhatKy {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Hàm lấy danh sách chính (Đã sửa để lọc theo ID chính xác)
    public function getAll($tour_id = '', $search_ngay = '') {
        $sql = "SELECT n.*, t.ten_tour, u.ho_ten 
                FROM nhatkytour n
                JOIN tours t ON n.tour_id = t.tour_id
                JOIN hdv h ON n.hdv_id = h.hdv_id
                JOIN users u ON h.user_id = u.user_id
                WHERE 1=1";

        // Nếu có chọn Tour (Lọc theo ID)
        if (!empty($tour_id)) {
            $sql .= " AND n.tour_id = '$tour_id'";
        }

        // Nếu có chọn Ngày
        if (!empty($search_ngay)) {
            $sql .= " AND n.ngay = '$search_ngay'";
        }

        $sql .= " ORDER BY n.ngay DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. Lấy danh sách các Tour ĐANG CÓ trong nhật ký (để đổ vào Dropdown)
    public function getDistinctTours() {
        // Chỉ lấy những tour đã có bài viết nhật ký
        $sql = "SELECT DISTINCT t.tour_id, t.ten_tour 
                FROM nhatkytour n
                JOIN tours t ON n.tour_id = t.tour_id
                ORDER BY t.ten_tour ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 3. Lấy danh sách các Ngày ĐANG CÓ trong nhật ký
    public function getDistinctDates($tour_id = null) {
        $sql = "SELECT DISTINCT ngay FROM nhatkytour WHERE 1=1";
        
        // Nếu có tour_id thì thêm điều kiện lọc
        if (!empty($tour_id)) {
            $sql .= " AND tour_id = :tour_id";
        }
        
        $sql .= " ORDER BY ngay DESC";
        
        $stmt = $this->conn->prepare($sql);
        
        // Bind tham số nếu có
        if (!empty($tour_id)) {
            $stmt->execute([':tour_id' => $tour_id]);
        } else {
            $stmt->execute();
        }
        
        return $stmt->fetchAll();
    }
}
?>