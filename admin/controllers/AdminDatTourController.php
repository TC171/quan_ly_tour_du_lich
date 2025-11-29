<?php
class AdminDatTourController
{
    private $datTour;

    public function __construct()
    {
        $this->datTour = new DatTour();
    }

    // Danh sách đặt tour
    public function list()
    {
        $datTours = $this->datTour->getAll();
        require_once './views/dat-tour/list.php';
    }

    // Form thêm đặt tour
    public function create()
    {
        require_once './views/admin/dat_tour/create.php';
    }

    // Lưu đặt tour
    public function store()
    {
        $data = [
            'tour_id' => $_POST['tour_id'],
            'ngay_dat' => $_POST['ngay_dat'],
            'trang_thai' => $_POST['trang_thai'],
            'tong_tien' => $_POST['tong_tien']
        ];

        $this->datTour->create($data);
        header("Location: ?act=list-dat-tour");
        exit();
    }

    // Form sửa đặt tour
    public function edit()
    {
        $id = $_GET['id'];
        $datTour = $this->datTour->getById($id);

        require_once './views/admin/dat_tour/edit.php';
    }

    // Cập nhật đặt tour
    public function update()
    {
        $id = $_POST['dat_tour_id'];
        $data = [
            'tour_id' => $_POST['tour_id'],
            'ngay_dat' => $_POST['ngay_dat'],
            'trang_thai' => $_POST['trang_thai'],
            'tong_tien' => $_POST['tong_tien']
        ];

        $this->datTour->update($id, $data);
        header("Location: ?act=list-dat-tour");
        exit();
    }

    // Xóa đặt tour
    public function delete()
    {
        $id = $_GET['id'];
        $this->datTour->delete($id);
        header("Location: ?act=list-dat-tour");
        exit();
    }
}
