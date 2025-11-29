<?php
class AdminKhachDatTourController {
    public $modelKhachDatTour;

    public function __construct() {
        $this->modelKhachDatTour = new AdminKhachDatTour();
    }

    public function list() {
        $listKhach = $this->modelKhachDatTour->getAllKhachDatTour();
        require_once __DIR__ . '/../views/khach_dat_tour/list.php';
    }

    public function delete() {
        $id = $_GET['id_khach'] ?? null;
        if ($id) {
            $this->modelKhachDatTour->deleteKhach($id);
        }
        header("Location: " . BASE_URL_ADMIN . '?act=khach-dat-tour');
        exit();
    }

    // --- MỚI: HIỂN THỊ FORM SỬA ---
    public function formEdit() {
        $id = $_GET['id_khach'] ?? null;
        if ($id) {
            $khach = $this->modelKhachDatTour->getDetailKhach($id);
            if ($khach) {
                require_once __DIR__ . '/../views/khach_dat_tour/edit.php';
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=khach-dat-tour');
            }
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=khach-dat-tour');
        }
    }

    // --- MỚI: XỬ LÝ CẬP NHẬT ---
    public function postEdit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['khach_id'] ?? null;
            $ho_ten = $_POST['ho_ten'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $nam_sinh = $_POST['nam_sinh'] ?? '';
            $cmnd_passport = $_POST['cmnd_passport'] ?? '';
            $yeu_cau = $_POST['yeu_cau_dac_biet'] ?? '';

            if ($id) {
                $this->modelKhachDatTour->updateKhach($id, $ho_ten, $gioi_tinh, $nam_sinh, $cmnd_passport, $yeu_cau);
            }
            header("Location: " . BASE_URL_ADMIN . '?act=khach-dat-tour');
            exit();
        }
    }
}
?>