<?php
class AdminBaoCaoThongKe {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // ... (Giữ nguyên 4 hàm đếm số liệu cũ: countTour, countDonDat, countKhachHang, countDoanhThu) ...
    public function countTour() {
        $sql = "SELECT COUNT(*) as tong_tour FROM tours";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['tong_tour'];
    }

    public function countDonDat() {
        $sql = "SELECT COUNT(*) as tong_don FROM bookings";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['tong_don'];
    }

    public function countKhachHang() {
        $sql = "SELECT COUNT(*) as tong_khach FROM users WHERE vai_tro != 'ADMIN'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['tong_khach'];
    }

    public function countDoanhThu() {
        try {
            $sql = "SELECT SUM(t.gia_tour * b.so_nguoi) as tong_doanh_thu
                    FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    WHERE b.trang_thai IN (1, 3)"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch()['tong_doanh_thu'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    // --- MỚI: DỮ LIỆU CHO BIỂU ĐỒ CỘT (DOANH THU 7 NGÀY QUA) ---
    public function getDoanhThu7Ngay() {
        try {
            // Thay đổi: Lấy dữ liệu trong 365 ngày gần nhất (để chắc chắn có dữ liệu)
            // Hoặc bỏ luôn điều kiện ngày tháng để lấy hết
            $sql = "SELECT DATE(b.ngay_dat) as ngay, SUM(t.gia_tour * b.so_nguoi) as doanh_thu
                    FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    WHERE b.trang_thai IN (1, 3) -- Đã xác nhận hoặc Hoàn thành
                    GROUP BY DATE(b.ngay_dat)
                    ORDER BY ngay ASC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return [];
        }
    }

    // --- MỚI: DỮ LIỆU CHO BIỂU ĐỒ TRÒN (TỶ LỆ LOẠI TOUR) ---
    public function getTyLeLoaiTour() {
        try {
            // Đếm số lượng tour theo từng loại (Trong nước / Quốc tế)
            $sql = "SELECT loai_tour, COUNT(*) as so_luong FROM tours GROUP BY loai_tour";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return [];
        }
    }
}
?>