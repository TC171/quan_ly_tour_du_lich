<?php
class AdminBaoCaoThongKe {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Đếm tổng số tour hiện có
    public function countTour() {
        $sql = "SELECT COUNT(*) as tong_tour FROM tours";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['tong_tour'];
    }

    // 2. Đếm tổng số đơn đặt tour
    public function countDonDat() {
        $sql = "SELECT COUNT(*) as tong_don FROM bookings";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['tong_don'];
    }

    // 3. Đếm tổng số khách hàng (User role = KHÁCH hoặc đếm trong bảng users)
    public function countKhachHang() {
        // Giả sử đếm tất cả user không phải ADMIN
        $sql = "SELECT COUNT(*) as tong_khach FROM users WHERE vai_tro != 'ADMIN'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['tong_khach'];
    }

    // 4. Tính tổng doanh thu (Chỉ tính các đơn Đã xác nhận hoặc Hoàn thành)
    // Giả sử trạng thái: 1 = Đã xác nhận, 3 = Hoàn thành
    public function countDoanhThu() {
        try {
            $sql = "SELECT SUM(t.gia_tour * b.so_nguoi) as tong_doanh_thu
                    FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    WHERE b.trang_thai IN (1, 3)"; // Chỉ tính tiền đơn đã xác nhận/hoàn thành
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch()['tong_doanh_thu'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    // 5. Lấy thống kê doanh thu theo ngày (Cho biểu đồ)
    // Lấy 7 ngày gần nhất
    public function getDoanhThuLast7Days() {
        try {
            $sql = "SELECT DATE(b.ngay_dat) as ngay, SUM(t.gia_tour * b.so_nguoi) as doanh_thu
                    FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    WHERE b.trang_thai IN (1, 3)
                    GROUP BY DATE(b.ngay_dat)
                    ORDER BY ngay DESC
                    LIMIT 7";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(); // Trả về mảng các ngày
        } catch (Exception $e) {
            return [];
        }
    }
}
?>