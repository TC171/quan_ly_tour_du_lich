<?php
class AdminKhachDatTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllKhachDatTour() {
        try {
            // Lấy tất cả dữ liệu
            $sql = "SELECT bk.*, b.ngay_khoi_hanh, t.ten_tour 
                    FROM booking_khach as bk
                    INNER JOIN bookings as b ON bk.booking_id = b.booking_id
                    INNER JOIN tours as t ON b.tour_id = t.tour_id 
                    ORDER BY bk.khach_id DESC"; // Sắp xếp theo khach_id cho chuẩn
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi SQL (Get All): " . $e->getMessage();
        }
    }

    public function deleteKhach($id) {
        try {
            // SỬA QUAN TRỌNG: Dùng đúng tên cột 'khach_id' trong Database
            $sql = "DELETE FROM booking_khach WHERE khach_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi SQL (Delete): " . $e->getMessage();
        }
    }
}
?>