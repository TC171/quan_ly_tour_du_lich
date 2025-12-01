<?php
class AdminPhanBo {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Lấy danh sách phân bổ (để hiển thị bảng)
    public function getAllPhanBo() {
        $sql = "SELECT pb.*, t.ten_tour, u.ho_ten as ten_hdv, t.ngay_tao
                FROM phanbo_hdv pb
                INNER JOIN tours t ON pb.tour_id = t.tour_id
                INNER JOIN hdv h ON pb.hdv_id = h.hdv_id
                INNER JOIN users u ON h.user_id = u.user_id
                ORDER BY pb.phanbo_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. Thêm phân bổ mới
    public function addPhanBo($tour_id, $hdv_id, $vai_tro) {
        // Kiểm tra xem đã phân công chưa để tránh trùng lặp
        $check = "SELECT * FROM phanbo_hdv WHERE tour_id = :t AND hdv_id = :h";
        $stmtCheck = $this->conn->prepare($check);
        $stmtCheck->execute([':t' => $tour_id, ':h' => $hdv_id]);
        
        if ($stmtCheck->rowCount() > 0) {
            return false; // Đã tồn tại
        }

        $sql = "INSERT INTO phanbo_hdv (tour_id, hdv_id, vai_tro) VALUES (:t, :h, :v)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':t' => $tour_id, ':h' => $hdv_id, ':v' => $vai_tro]);
    }

    // 3. Xóa phân bổ
    public function deletePhanBo($id) {
        $sql = "DELETE FROM phanbo_hdv WHERE phanbo_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // --- HÀM PHỤ TRỢ CHO FORM ---
    
    // Lấy danh sách Tour để chọn
    public function getAllTours() {
        $sql = "SELECT tour_id, ten_tour FROM tours WHERE trang_thai = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy danh sách HDV để chọn
    public function getAllHDVs() {
        $sql = "SELECT h.hdv_id, u.ho_ten 
                FROM hdv h 
                INNER JOIN users u ON h.user_id = u.user_id 
                WHERE h.trang_thai = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>