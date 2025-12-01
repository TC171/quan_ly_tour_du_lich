<?php
require_once './models/AdminPhanBo.php';

class AdminPhanBoController {
    public $modelPhanBo;

    public function __construct() {
        $this->modelPhanBo = new AdminPhanBo();
    }

    // Hiển thị danh sách
    public function danhSach() {
        $listPhanBo = $this->modelPhanBo->getAllPhanBo();
        require_once './views/phan_bo/list.php';
    }

    // Hiển thị form thêm mới
    public function formAdd() {
        $listTour = $this->modelPhanBo->getAllTours();
        $listHDV = $this->modelPhanBo->getAllHDVs();
        require_once './views/phan_bo/add.php';
    }

    // Xử lý thêm mới
    public function postAdd() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_id = $_POST['tour_id'];
            $hdv_id = $_POST['hdv_id'];
            $vai_tro = $_POST['vai_tro'];

            $result = $this->modelPhanBo->addPhanBo($tour_id, $hdv_id, $vai_tro);
            
            if ($result) {
                header("Location: ?act=phan-bo-tour");
            } else {
                echo "<script>alert('Lỗi: HDV này đã được phân công vào tour này rồi!'); window.history.back();</script>";
            }
        }
    }

    // Xóa
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelPhanBo->deletePhanBo($id);
        }
        header("Location: ?act=phan-bo-tour");
    }
}
?>