<?php
class DatTour
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả đặt tour
    public function getAll()
    {
        $sql = "SELECT dt.*, t.ten_tour, t.gia_tour 
                FROM dat_tour dt
                JOIN tour t ON dt.tour_id = t.tour_id
                ORDER BY dt.dat_tour_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy đặt tour theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM dat_tour WHERE dat_tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm đặt tour
    public function create($data)
    {
        $sql = "INSERT INTO dat_tour (tour_id, ngay_dat, trang_thai, tong_tien)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['tour_id'],
            $data['ngay_dat'],
            $data['trang_thai'],
            $data['tong_tien']
        ]);
    }

    // Cập nhật đặt tour
    public function update($id, $data)
    {
        $sql = "UPDATE dat_tour 
                SET tour_id = ?, ngay_dat = ?, trang_thai = ?, tong_tien = ?
                WHERE dat_tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['tour_id'],
            $data['ngay_dat'],
            $data['trang_thai'],
            $data['tong_tien'],
            $id
        ]);
    }

    // Xóa đặt tour
    public function delete($id)
    {
        $sql = "DELETE FROM dat_tour WHERE dat_tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
