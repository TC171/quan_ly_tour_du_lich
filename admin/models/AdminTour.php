<?php
class Tour
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy danh sách tour
    public function getAll()
    {
        $sql = "SELECT * FROM tour ORDER BY tour_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
