<?php
// admin/controllers/AdminLichTrinhTourController.php
require_once __DIR__ . '/../models/LichTrinhTourModel.php';

require_once __DIR__ . '/../models/AdminTour.php'; // để lấy danh sách tour

class AdminLichTrinhTourController
{
    private $model;
    private $tourModel;

    public function __construct()
    {
        $this->model = new LichTrinhTour();
        $this->tourModel = new Tour();
    }

    // Hiển thị danh sách lịch trình
    // public function danhSachLichTrinh()
    // {
    //     $lists = $this->model->getAll();
    //     require __DIR__ . '/../views/lich-trinh/list.php';
    // }
    public function danhSachLichTrinh()
    {
        // Lấy danh sách tour để dropdown
        $tours = $this->tourModel->getAll();

        // Nếu có filter tour_id từ GET
        $tour_id = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 0;

        if ($tour_id > 0) {
            // Lấy lịch trình của tour được chọn
            $lists = $this->model->getByTour($tour_id);
        } else {
            // Lấy tất cả lịch trình
            $lists = $this->model->getAll();
        }

        require __DIR__ . '/../views/lich-trinh/list.php';
    }


    // Form thêm lịch trình
   
    public function themLichTrinh()
    {
        $tourModel = new Tour();
        $tours = $tourModel->getAll(); // Lấy danh sách tour để hiển thị dropdown

        $error_message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tour_id' => intval($_POST['tour_id']),
                'ngay_thu' => intval($_POST['ngay_thu']),
                'diem_tham_quan' => trim($_POST['diem_tham_quan']),
                'thoi_gian' => trim($_POST['thoi_gian']),
                'mo_ta' => trim($_POST['mo_ta'])
            ];

            // Validate dữ liệu
            if ($data['tour_id'] <= 0) {
                $error_message = 'Vui lòng chọn tour hợp lệ';
            } elseif (empty($data['diem_tham_quan'])) {
                $error_message = 'Nhập điểm tham quan';
            } else {
                $id = $this->model->insert($data);
                if ($id) {
                    $_SESSION['success'] = 'Thêm lịch trình thành công!';
                    header('Location: ?act=lich-trinh&tour_id=' . $data['tour_id']);
                    exit;
                } else {
                    $error_message = $this->model->lastError ?? 'Thêm thất bại';
                }
            }
        }

        require __DIR__ . '/../views/lich-trinh/add.php';
    }


    // Form sửa lịch trình
    public function suaLichTrinh() // đã lấy đc 
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?act=lich-trinh');
            exit;
        }

        $lt = $this->model->getOne($id); // phải có phương thức getOne trong model
        if (!$lt) {
            header('Location: ?act=lich-trinh');
            exit;
        }

        // Nếu submit form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ngay_thu' => $_POST['ngay_thu'],
                'diem_tham_quan' => $_POST['diem_tham_quan'],
                'thoi_gian' => $_POST['thoi_gian'],
                'mo_ta' => $_POST['mo_ta']
            ];
            $this->model->update($id, $data);
            $_SESSION['success'] = 'Cập nhật lịch trình thành công!';
            header('Location: index.php?act=lich-trinh&tour_id=' . $lt['tour_id']);
            // header('Location: ?act=lich-trinh&tour_id=' . $lt['tour_id']);s
            exit;
        }

        // load view
        require __DIR__ . '/../views/lich-trinh/edit.php';
    }


    public function xoaLichTrinh()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id) {
            $ok = $this->model->delete($id);
            $msg = $ok ? 'Xóa lịch trình thành công!' : 'Xóa thất bại!';
        } else {
            $msg = 'Không xác định lịch trình cần xóa!';
        }

        // Lưu thông báo vào session
        $_SESSION['message'] = $msg;

        // Chuyển về danh sách lịch trình
        header('Location: index.php?act=lich-trinh');
        exit;
    }
}
