<?php
class AdminChiPhiTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Lấy danh sách chi phí (để hiển thị bảng)
    public function getAllChiPhi() {
        try {
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
    
    // 2. Thêm mới chi phí
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

    // 3. Lấy danh sách Tour (Dùng cho dropdown khi Sửa/Thêm)
    public function getAllTours() {
        try {
            $sql = "SELECT * FROM tours"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    // 4. Lấy thông tin chi tiết 1 chi phí (Để điền vào form Sửa)
    public function getDetailChiPhi($id) {
        try {
            $sql = "SELECT * FROM chiphitour WHERE chiphi_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // 5. Cập nhật chi phí (Chức năng Sửa)
    public function updateChiPhi($id, $tour_id, $loai_chi_phi, $so_tien, $ghi_chu, $ngay_phat_sinh) {
        try {
            $sql = "UPDATE chiphitour 
                    SET tour_id = :tour_id,
                        loai_chi_phi = :loai_chi_phi,
                        so_tien = :so_tien,
                        ghi_chu = :ghi_chu,
                        ngay_phat_sinh = :ngay_phat_sinh
                    WHERE chiphi_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tour_id' => $tour_id,
                ':loai_chi_phi' => $loai_chi_phi,
                ':so_tien' => $so_tien,
                ':ghi_chu' => $ghi_chu,
                ':ngay_phat_sinh' => $ngay_phat_sinh,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // 6. Xóa chi phí
    public function deleteChiPhi($id) {
        try {
            $sql = "DELETE FROM chiphitour WHERE chiphi_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
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