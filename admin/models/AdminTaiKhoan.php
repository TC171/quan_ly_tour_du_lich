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
        $sql = "SELECT * FROM users WHERE ten_dang_nhap = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }
}
