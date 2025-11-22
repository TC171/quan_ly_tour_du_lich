<?php
class AdminTaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); 
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }
}
