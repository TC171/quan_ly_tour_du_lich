<?php

class Tour
{
    private $conn;

    // Hàm kết nối đến cơ sở dữ liệu
    private function connectDB()
    {
        // Thông tin cấu hình kết nối DB
        $host = 'localhost';
        $db   = 'quan_ly_tour';
        $user = 'root';  // Đổi theo user của bạn
        $pass = '';      // Đổi theo password của bạn
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            // Thông báo lỗi khi kết nối không thành công
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }

    // Lấy danh sách tour
    public function getAll()
    {
        // Nếu chưa kết nối, thực hiện kết nối lại
        if ($this->conn === null) {
            $this->connectDB();
        }

        // Cập nhật tên bảng từ "tour" thành "tours"
        $sql = "SELECT * FROM tours ORDER BY tour_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin tour theo ID
    public function getById($id)
    {
        if ($this->conn === null) {
            $this->connectDB();
        }

        $sql = "SELECT * FROM tours WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // Thêm tour mới
    public function add($data)
    {
        if ($this->conn === null) {
            $this->connectDB();
        }

        $sql = "INSERT INTO tours (ten_tour, loai_tour, mo_ta, gia_tour, hinh_anh, chinh_sach, trang_thai) 
                VALUES (:ten_tour, :loai_tour, :mo_ta, :gia_tour, :hinh_anh, :chinh_sach, :trang_thai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ten_tour', $data['ten_tour']);
        $stmt->bindParam(':loai_tour', $data['loai_tour']);
        $stmt->bindParam(':mo_ta', $data['mo_ta']);
        $stmt->bindParam(':gia_tour', $data['gia_tour']);
        $stmt->bindParam(':hinh_anh', $data['hinh_anh']);
        $stmt->bindParam(':chinh_sach', $data['chinh_sach']);
        $stmt->bindParam(':trang_thai', $data['trang_thai'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Cập nhật tour
    public function update($id, $data)
    {
        if ($this->conn === null) {
            $this->connectDB();
        }

        $sql = "UPDATE tours SET ten_tour = :ten_tour, loai_tour = :loai_tour, mo_ta = :mo_ta, 
                gia_tour = :gia_tour, hinh_anh = :hinh_anh, chinh_sach = :chinh_sach, 
                trang_thai = :trang_thai WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ten_tour', $data['ten_tour']);
        $stmt->bindParam(':loai_tour', $data['loai_tour']);
        $stmt->bindParam(':mo_ta', $data['mo_ta']);
        $stmt->bindParam(':gia_tour', $data['gia_tour']);
        $stmt->bindParam(':hinh_anh', $data['hinh_anh']);
        $stmt->bindParam(':chinh_sach', $data['chinh_sach']);
        $stmt->bindParam(':trang_thai', $data['trang_thai'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Xóa tour
    public function delete($id)
    {
        if ($this->conn === null) {
            $this->connectDB();
        }

        $sql = "DELETE FROM tours WHERE tour_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Lấy thống kê tour
    public function getStatistics()
    {
        if ($this->conn === null) {
            $this->connectDB();
        }

        $sql = "SELECT 
                COUNT(*) as tong_tour,
                SUM(CASE WHEN trang_thai = 1 THEN 1 ELSE 0 END) as tour_dang_ban,
                SUM(CASE WHEN trang_thai = 0 THEN 1 ELSE 0 END) as tour_tam_ngung
                FROM tours";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
