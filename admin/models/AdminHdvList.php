<?php
class AdminHdvList {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy danh sách: JOIN bảng hdv với users để lấy họ tên
    public function getAll() {
        $sql = "SELECT h.*, u.ho_ten, u.email, u.dien_thoai, u.trang_thai as trang_thai_user
                FROM hdv h 
                INNER JOIN users u ON h.user_id = u.user_id 
                ORDER BY h.hdv_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Thêm mới: Dùng Transaction để đảm bảo toàn vẹn dữ liệu
    public function insert($ho_ten, $email, $password, $dien_thoai, $ngay_sinh, $anh, $chuyen_mon, $ngon_ngu, $kinh_nghiem) {
        try {
            $this->conn->beginTransaction(); // Bắt đầu giao dịch

            // B1: Insert vào bảng USERS trước
            $sqlUser = "INSERT INTO users (ho_ten, email, mat_khau, dien_thoai, vai_tro, ngay_tao, trang_thai) 
                        VALUES (:ho_ten, :email, :mat_khau, :dien_thoai, 'HDV', NOW(), 1)";
            $stmtUser = $this->conn->prepare($sqlUser);
            $stmtUser->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':mat_khau' => $password, // Thực tế nên dùng password_hash($password, PASSWORD_DEFAULT)
                ':dien_thoai' => $dien_thoai
            ]);
            
            // Lấy ID vừa tạo
            $user_id = $this->conn->lastInsertId();

            // B2: Insert vào bảng HDV dùng user_id ở trên
            $sqlHdv = "INSERT INTO hdv (user_id, ngay_sinh, anh, chuyen_mon, ngon_ngu, kinh_nghiem, trang_thai) 
                       VALUES (:user_id, :ngay_sinh, :anh, :chuyen_mon, :ngon_ngu, :kinh_nghiem, 1)";
            $stmtHdv = $this->conn->prepare($sqlHdv);
            $stmtHdv->execute([
                ':user_id' => $user_id,
                ':ngay_sinh' => $ngay_sinh,
                ':anh' => $anh,
                ':chuyen_mon' => $chuyen_mon,
                ':ngon_ngu' => $ngon_ngu,
                ':kinh_nghiem' => $kinh_nghiem
            ]);

            $this->conn->commit(); // Xác nhận thành công
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack(); // Hoàn tác nếu lỗi
            return false;
        }
    }

    // Lấy thông tin chi tiết để sửa
    public function getDetail($id) {
        $sql = "SELECT h.*, u.ho_ten, u.email, u.dien_thoai, u.mat_khau
                FROM hdv h 
                JOIN users u ON h.user_id = u.user_id 
                WHERE h.hdv_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Cập nhật: Update cả 2 bảng
    public function update($hdv_id, $user_id, $ho_ten, $dien_thoai, $ngay_sinh, $anh, $chuyen_mon, $ngon_ngu, $kinh_nghiem) {
        try {
            $this->conn->beginTransaction();

            // Update Users
            $sqlUser = "UPDATE users SET ho_ten = :ho_ten, dien_thoai = :dien_thoai WHERE user_id = :user_id";
            $stmtUser = $this->conn->prepare($sqlUser);
            $stmtUser->execute([':ho_ten'=>$ho_ten, ':dien_thoai'=>$dien_thoai, ':user_id'=>$user_id]);

            // Update HDV
            $sqlHdv = "UPDATE hdv SET ngay_sinh = :ngay_sinh, anh = :anh, chuyen_mon = :chuyen_mon, 
                       ngon_ngu = :ngon_ngu, kinh_nghiem = :kinh_nghiem WHERE hdv_id = :hdv_id";
            $stmtHdv = $this->conn->prepare($sqlHdv);
            $stmtHdv->execute([
                ':ngay_sinh' => $ngay_sinh, ':anh' => $anh, ':chuyen_mon' => $chuyen_mon,
                ':ngon_ngu' => $ngon_ngu, ':kinh_nghiem' => $kinh_nghiem, ':hdv_id' => $hdv_id
            ]);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // Xóa (Tùy chọn: Xóa cứng hoặc ẩn đi)
    public function delete($hdv_id) {
        $hdv = $this->getDetail($hdv_id);
        if($hdv){
            try {
                $this->conn->beginTransaction();
                $this->conn->exec("DELETE FROM hdv WHERE hdv_id = $hdv_id");
                $this->conn->exec("DELETE FROM users WHERE user_id = " . $hdv['user_id']); // Xóa luôn user
                $this->conn->commit();
            } catch (Exception $e) {
                $this->conn->rollBack();
            }
        }
    }
}
?>