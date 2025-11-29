<?php
class AdminDatTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllBookings() {
        try {
            // SỬA LỖI QUAN TRỌNG:
            // 1. Kiểm tra lại tên bảng: là 'users' hay 'nguoi_dung'?
            // 2. Kiểm tra lại khóa chính: là 'u.id' hay 'u.user_id'?
            
            // Dưới đây mình thử đổi thành 'u.user_id'. 
            // Nếu vẫn lỗi, bạn hãy mở phpMyAdmin xem cột khóa chính bảng users tên là gì rồi thay vào chỗ 'user_id' nhé.
            
            $sql = "SELECT b.*, t.ten_tour, u.ho_ten as ten_nguoi_dat, u.* FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    INNER JOIN users as u ON b.nguoi_dat_id = u.user_id 
                    ORDER BY b.booking_id DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }

    public function deleteBooking($id) {
        try {
            $sql = "DELETE FROM bookings WHERE booking_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }
}
?>