<?php
class AdminDatTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Lấy danh sách
    public function getAllBookings() {
        try {
            // SỬA: 
            // - JOIN với bảng users qua u.user_id
            // - Lấy u.dien_thoai
            $sql = "SELECT b.*, t.ten_tour, t.gia_tour, u.ho_ten as ten_nguoi_dat, u.email, u.dien_thoai
                    FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    INNER JOIN users as u ON b.nguoi_dat_id = u.user_id 
                    ORDER BY b.booking_id DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi SQL Get All: " . $e->getMessage();
        }
    }

    // 2. Hàm xóa
    public function deleteBooking($id) {
        try {
            // SỬA: Dùng booking_id
            $sql = "DELETE FROM bookings WHERE booking_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi SQL Delete: " . $e->getMessage();
        }
    }

    // 3. Lấy chi tiết 1 đơn hàng
    public function getDetailBooking($id) {
        try {
            // SỬA: JOIN u.user_id và WHERE b.booking_id
            $sql = "SELECT b.*, t.ten_tour, t.gia_tour, u.ho_ten as ten_nguoi_dat, u.email, u.dien_thoai
                    FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    INNER JOIN users as u ON b.nguoi_dat_id = u.user_id 
                    WHERE b.booking_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi SQL Detail: " . $e->getMessage();
        }
    }

    // 4. Cập nhật trạng thái (Hàm bị lỗi lúc nãy)
    public function updateBooking($id, $trang_thai) {
        try {
            // SỬA QUAN TRỌNG: Dùng 'WHERE booking_id = :id'
            $sql = "UPDATE bookings SET trang_thai = :trang_thai WHERE booking_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            die("Lỗi SQL Update: " . $e->getMessage());
        }
    }
}
?>