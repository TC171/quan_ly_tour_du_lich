<?php
class AdminKhachDatTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Lấy danh sách (Giữ nguyên)
    public function getAllKhachDatTour() {
        try {
            $sql = "SELECT bk.*, b.ngay_khoi_hanh, t.ten_tour 
                    FROM booking_khach as bk
                    INNER JOIN bookings as b ON bk.booking_id = b.booking_id
                    INNER JOIN tours as t ON b.tour_id = t.tour_id 
                    ORDER BY bk.khach_id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }

    // 2. Xóa (Giữ nguyên)
    public function deleteKhach($id) {
        try {
            $sql = "DELETE FROM booking_khach WHERE khach_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }

    // --- 3. MỚI: LẤY CHI TIẾT 1 KHÁCH ---
    public function getDetailKhach($id) {
        try {
            $sql = "SELECT * FROM booking_khach WHERE khach_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }

    // --- 4. MỚI: CẬP NHẬT THÔNG TIN KHÁCH ---
    public function updateKhach($id, $ho_ten, $gioi_tinh, $nam_sinh, $cmnd_passport, $yeu_cau) {
        try {
            $sql = "UPDATE booking_khach 
                    SET ho_ten = :ho_ten,
                        gioi_tinh = :gioi_tinh,
                        nam_sinh = :nam_sinh,
                        cmnd_passport = :cmnd_passport,
                        yeu_cau_dac_biet = :yeu_cau
                    WHERE khach_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':gioi_tinh' => $gioi_tinh,
                ':nam_sinh' => $nam_sinh,
                ':cmnd_passport' => $cmnd_passport,
                ':yeu_cau' => $yeu_cau,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }
}
?>