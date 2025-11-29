<?php
class AdminKhachDatTourController
{
    private $khach;

    public function __construct()
    {
        $this->khach = new KhachDatTour();
    }

    // Danh sách khách
    public function list()
    {
        $khachs = $this->khach->getAll();
        require_once './views/khach-dat-tour/list.php';
    }

    // Form thêm khách
    public function create()
    {
        require_once './views/khach-dat-tour/create.php';
    }

    // Lưu khách mới
    public function store()
    {
        $data = [
            'dat_tour_id' => $_POST['dat_tour_id'],
            'ho_ten' => $_POST['ho_ten'],
            'so_dien_thoai' => $_POST['so_dien_thoai'],
            'email' => $_POST['email'],
            'ghi_chu' => $_POST['ghi_chu']
        ];

        $this->khach->create($data);
        header("Location: ?act=list-khach-dat-tour");
        exit();
    }

    // Form sửa khách
    public function edit()
    {
        $id = $_GET['id'];
        $khach = $this->khach->getById($id);
        require_once './views/khach-dat-tour/edit.php';
    }

    // Cập nhật khách
    public function update()
    {
        $id = $_POST['khach_id'];
        $data = [
            'dat_tour_id' => $_POST['dat_tour_id'],
            'ho_ten' => $_POST['ho_ten'],
            'so_dien_thoai' => $_POST['so_dien_thoai'],
            'email' => $_POST['email'],
            'ghi_chu' => $_POST['ghi_chu']
        ];

        $this->khach->update($id, $data);
        header("Location: ?act=list-khach-dat-tour");
        exit();
    }

    // Xóa khách
    public function delete()
    {
        $id = $_GET['id'];
        $this->khach->delete($id);
        header("Location: ?act=list-khach-dat-tour");
        exit();
    }
}
