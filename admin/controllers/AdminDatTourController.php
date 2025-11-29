<?php
class AdminDatTourController {
    public $modelDatTour;

    public function __construct() {
        $this->modelDatTour = new AdminDatTour();
    }

   public function getAllBookings() {
        try {
            // SỬA: Thêm t.gia_tour vào danh sách cột cần lấy
            $sql = "SELECT b.*, t.ten_tour, t.gia_tour, u.ho_ten as ten_nguoi_dat, u.email, u.so_dien_thoai
                    FROM bookings as b
                    INNER JOIN tours as t ON b.tour_id = t.tour_id
                    INNER JOIN users as u ON b.nguoi_dat_id = u.id 
                    ORDER BY b.booking_id DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }

    public function delete() {
        $id = $_GET['id_booking'] ?? null;
        if ($id) {
            $this->modelDatTour->deleteBooking($id);
        }
        header("Location: " . BASE_URL_ADMIN . '?act=dat-tour');
        exit();
    }
}
?>