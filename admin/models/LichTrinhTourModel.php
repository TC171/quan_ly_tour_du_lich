<?php
// admin/models/LichTrinhTourModel.php
class LichTrinhTour
{
    private $conn;
    public $lastError = null;

    public function __construct()
    {
        $this->conn = connectDB(); // connectDB() trả về PDO
    }

    // Lấy tất cả lịch trình, join với bảng tours
    public function getAll()
    {
        try {
            $sql = "SELECT lt.*, t.ten_tour 
                    FROM tour_lichtrinh lt
                    LEFT JOIN tours t ON lt.tour_id = t.tour_id
                    ORDER BY lt.ngay_thu ASC"; // hoặc DESC theo nhu cầu
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log('GET ALL LICH TRINH ERROR: ' . $e->getMessage());
            return [];
        }
    }

    // Lấy lịch trình theo tour
    public function getByTour($tour_id)
    {
        $sql = "SELECT lt.*, t.ten_tour 
                FROM tour_lichtrinh lt
                LEFT JOIN tours t ON lt.tour_id = t.tour_id
                WHERE lt.tour_id = :tour_id
                ORDER BY lt.ngay_thu ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['tour_id' => $tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
// đã lấy đc id
    public function getOne($id)
    {
        try {
            $sql = "SELECT * FROM tour_lichtrinh WHERE lichtrinh_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // trả về mảng 1 dòng
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            return false;
        }
    }



    // Thêm lịch trình
    public function insert($data)
    {
        try {
            $sql = "INSERT INTO tour_lichtrinh (tour_id, ngay_thu, diem_tham_quan, thoi_gian, mo_ta)
                    VALUES (:tour_id, :ngay_thu, :diem_tham_quan, :thoi_gian, :mo_ta)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'tour_id' => $data['tour_id'],
                'ngay_thu' => $data['ngay_thu'],
                'diem_tham_quan' => $data['diem_tham_quan'],
                'thoi_gian' => $data['thoi_gian'],
                'mo_ta' => $data['mo_ta']
            ]);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log('INSERT LICH_TRINH ERROR: ' . $e->getMessage());
            return false;
        }
    }

    // Cập nhật
    public function update($id, $data)
    {
        try {
            $sql = "UPDATE tour_lichtrinh 
                    SET ngay_thu = :ngay_thu, diem_tham_quan = :diem_tham_quan, thoi_gian = :thoi_gian, mo_ta = :mo_ta
                    WHERE lichtrinh_id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                'ngay_thu' => $data['ngay_thu'],
                'diem_tham_quan' => $data['diem_tham_quan'],
                'thoi_gian' => $data['thoi_gian'],
                'mo_ta' => $data['mo_ta'],
                'id' => $id
            ]);
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log('UPDATE LICH_TRINH ERROR: ' . $e->getMessage());
            return false;
        }
    }



    // Xóa
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM tour_lichtrinh WHERE lichtrinh_id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            error_log('DELETE LICH_TRINH ERROR: ' . $e->getMessage());
            return false;
        }
    }
}
