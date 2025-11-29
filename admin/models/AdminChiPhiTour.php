<?php
class AdminChiPhiTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllChiPhi() {
        try {
            // SỬA LẠI: t.tour_id (vì bảng tours của bạn dùng cột tour_id)
            $sql = "SELECT cp.*, t.ten_tour 
                    FROM chiphitour as cp
                    INNER JOIN tours as t ON cp.tour_id = t.tour_id 
                    ORDER BY cp.ngay_phat_sinh DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
    
    // Hàm thêm mới chi phí (Chuẩn bị cho bước tiếp theo)
    public function insertChiPhi($tour_id, $loai_chi_phi, $so_tien, $ghi_chu, $ngay_phat_sinh) {
        try {
            $sql = "INSERT INTO chiphitour (tour_id, loai_chi_phi, so_tien, ghi_chu, ngay_phat_sinh) 
                    VALUES (:tour_id, :loai_chi_phi, :so_tien, :ghi_chu, :ngay_phat_sinh)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tour_id' => $tour_id,
                ':loai_chi_phi' => $loai_chi_phi,
                ':so_tien' => $so_tien,
                ':ghi_chu' => $ghi_chu,
                ':ngay_phat_sinh' => $ngay_phat_sinh
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}
?>