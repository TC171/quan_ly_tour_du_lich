<?php
class HdvNhatKy {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // 1. Lấy thông tin HDV dựa trên user_id đăng nhập
    public function getHdvInfo($user_id) {
        $sql = "SELECT * FROM hdv WHERE user_id = :uid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':uid' => $user_id]);
        return $stmt->fetch();
    }

    // 2. Lấy danh sách Tour mà HDV này được phân công
    public function getMyTours($hdv_id) {
        $sql = "SELECT p.*, t.ten_tour, t.ngay_bat_dau, t.ngay_ket_thuc, t.hinh_anh
                FROM phanbo_hdv p
                JOIN tours t ON p.tour_id = t.tour_id
                WHERE p.hdv_id = :hid
                ORDER BY t.ngay_bat_dau DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':hid' => $hdv_id]);
        return $stmt->fetchAll();
    }

    // 3. Kiểm tra bảo mật: Tour này có phải của HDV này không?
    public function checkTourOwner($tour_id, $hdv_id) {
        $sql = "SELECT count(*) FROM phanbo_hdv WHERE tour_id = :tid AND hdv_id = :hid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tid' => $tour_id, ':hid' => $hdv_id]);
        return $stmt->fetchColumn() > 0;
    }

    // 4. Lấy nhật ký cũ theo ngày
    public function getNhatKy($tour_id, $hdv_id, $ngay) {
        $sql = "SELECT * FROM nhatkytour WHERE tour_id = :tid AND hdv_id = :hid AND ngay = :ngay";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':tid' => $tour_id, ':hid' => $hdv_id, ':ngay' => $ngay]);
        return $stmt->fetch();
    }

    // 5. Lưu hoặc Cập nhật nhật ký
    public function saveNhatKy($tour_id, $hdv_id, $ngay, $ghi_chu, $hinh_anh) {
        // Kiểm tra xem đã có chưa
        $check = $this->getNhatKy($tour_id, $hdv_id, $ngay);

        if ($check) {
            // Cập nhật
            $sql = "UPDATE nhatkytour SET ghi_chu = :gc";
            if (!empty($hinh_anh)) {
                $sql .= ", hinh_anh = '$hinh_anh'";
            }
            // Reset trạng thái về 0 (Chờ duyệt) khi sửa lại
            $sql .= ", trang_thai = 0 WHERE nhatky_id = :id";
            
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':gc' => $ghi_chu, ':id' => $check['nhatky_id']]);
        } else {
            // Thêm mới
            $sql = "INSERT INTO nhatkytour (tour_id, hdv_id, ngay, ghi_chu, hinh_anh, trang_thai) 
                    VALUES (:tid, :hid, :ngay, :gc, :img, 0)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':tid' => $tour_id, ':hid' => $hdv_id, ':ngay' => $ngay, 
                ':gc' => $ghi_chu, ':img' => $hinh_anh
            ]);
        }
    }
}
?>