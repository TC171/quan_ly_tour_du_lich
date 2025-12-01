<?php
class AdminLichTrinhTour {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAll() {
        // Lấy danh sách lịch trình kèm tên Tour
        $sql = "SELECT lt.*, t.ten_tour 
                FROM tour_lichtrinh lt
                INNER JOIN tours t ON lt.tour_id = t.tour_id
                ORDER BY t.ten_tour, lt.ngay_thu ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insert($data) {
        $sql = "INSERT INTO tour_lichtrinh (tour_id, ngay_thu, diem_tham_quan, thoi_gian, mo_ta) 
                VALUES (:tour_id, :ngay_thu, :diem_tham_quan, :thoi_gian, :mo_ta)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':tour_id' => $data['tour_id'],
            ':ngay_thu' => $data['ngay_thu'],
            ':diem_tham_quan' => $data['diem_tham_quan'],
            ':thoi_gian' => $data['thoi_gian'],
            ':mo_ta' => $data['mo_ta']
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM tour_lichtrinh WHERE lichtrinh_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>