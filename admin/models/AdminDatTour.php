<?php
class DatTour
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả đặt tour kèm thông tin hành trình và tour
    public function getAll()
    {
        $sql = "SELECT dt.dat_tour_id, dt.ngay_dat, dt.tong_tien, dt.trang_thai AS dat_trang_thai,
                       ht.hanh_trinh_id, ht.gia_mua, ht.ngay_bat_dau, ht.ngay_ket_thuc,
                       t.tour_id, t.ten_tour, t.so_ngay, t.gia_mac_dinh
                FROM dat_tour dt
                JOIN hanh_trinh ht ON dt.hanh_trinh_id = ht.hanh_trinh_id
                JOIN tour t ON ht.tour_id = t.tour_id
                ORDER BY dt.dat_tour_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy đặt tour theo ID
    public function getById($id)
    {
        $sql = "SELECT dt.dat_tour_id, dt.ngay_dat, dt.tong_tien, dt.trang_thai AS dat_trang_thai,
                       ht.hanh_trinh_id, ht.gia_mua, ht.ngay_bat_dau, ht.ngay_ket_thuc,
                       t.tour_id, t.ten_tour, t.so_ngay, t.gia_mac_dinh
                FROM dat_tour dt
                JOIN hanh_trinh ht ON dt.hanh_trinh_id = ht.hanh_trinh_id
                JOIN tour t ON ht.tour_id = t.tour_id
                WHERE dt.dat_tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm đặt tour
    public function create($data)
    {
        $sql = "INSERT INTO dat_tour (hanh_trinh_id, ngay_dat, trang_thai, tong_tien)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['hanh_trinh_id'],
            $data['ngay_dat'],
            $data['trang_thai'],
            $data['tong_tien']
        ]);
    }

    // Cập nhật đặt tour
    public function update($id, $data)
    {
        $sql = "UPDATE dat_tour 
                SET hanh_trinh_id = ?, ngay_dat = ?, trang_thai = ?, tong_tien = ?
                WHERE dat_tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['hanh_trinh_id'],
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
