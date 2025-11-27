<?php
class KhachDatTour
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả khách theo đặt tour
    public function getAll()
    {
        $sql = "SELECT k.*, dt.ngay_dat, t.ten_tour
                FROM khach_trong_dat_tour k
                JOIN dat_tour dt ON k.dat_tour_id = dt.dat_tour_id
                JOIN hanh_trinh ht ON dt.hanh_trinh_id = ht.hanh_trinh_id
                JOIN tour t ON ht.tour_id = t.tour_id
                ORDER BY k.khach_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy khách theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM khach_trong_dat_tour WHERE khach_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm khách
    public function create($data)
    {
        $sql = "INSERT INTO khach_trong_dat_tour (dat_tour_id, ho_ten, so_dien_thoai, email, ghi_chu)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['dat_tour_id'],
            $data['ho_ten'],
            $data['so_dien_thoai'],
            $data['email'],
            $data['ghi_chu'] ?? null
        ]);
    }

    // Cập nhật khách
    public function update($id, $data)
    {
        $sql = "UPDATE khach_trong_dat_tour 
                SET dat_tour_id = ?, ho_ten = ?, so_dien_thoai = ?, email = ?, ghi_chu = ?
                WHERE khach_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['dat_tour_id'],
            $data['ho_ten'],
            $data['so_dien_thoai'],
            $data['email'],
            $data['ghi_chu'] ?? null,
            $id
        ]);
    }

    // Xóa khách
    public function delete($id)
    {
        $sql = "DELETE FROM khach_trong_dat_tour WHERE khach_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
