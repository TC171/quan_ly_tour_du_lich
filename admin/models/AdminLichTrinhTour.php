<?php
require_once 'connectDB.php'; // file chứa hàm connectDB()

class LichTrinhTour {

    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // dùng hàm connectDB() thay cho class Database
    }

    // Lấy tất cả lịch trình
    public function getAll() {
        $sql = "SELECT lt.*, t.ten_tour, h.ho_ten AS hdv
                FROM lich_trinh_tour lt
                JOIN tour t ON lt.tour_id = t.tour_id
                JOIN huong_dan_vien h ON lt.hdv_id = h.hdv_id
                ORDER BY lt.ngay_khoi_hanh DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy lịch trình theo ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM lich_trinh_tour WHERE lich_trinh_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Thêm lịch trình
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO lich_trinh_tour (tour_id, hdv_id, ngay_khoi_hanh, ngay_ket_thuc, phuong_tien, khach_san, trang_thai) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "iisssss",
            $data['tour_id'],
            $data['hdv_id'],
            $data['ngay_khoi_hanh'],
            $data['ngay_ket_thuc'],
            $data['phuong_tien'],
            $data['khach_san'],
            $data['trang_thai']
        );
        return $stmt->execute();
    }

    // Cập nhật lịch trình
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE lich_trinh_tour SET tour_id=?, hdv_id=?, ngay_khoi_hanh=?, ngay_ket_thuc=?, phuong_tien=?, khach_san=?, trang_thai=? WHERE lich_trinh_id=?");
        $stmt->bind_param(
            "iisssssi",
            $data['tour_id'],
            $data['hdv_id'],
            $data['ngay_khoi_hanh'],
            $data['ngay_ket_thuc'],
            $data['phuong_tien'],
            $data['khach_san'],
            $data['trang_thai'],
            $id
        );
        return $stmt->execute();
    }

    // Xóa lịch trình
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM lich_trinh_tour WHERE lich_trinh_id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>