<?php
class AdminTourController
{
    public $tour;

    public function __construct()
    {
        $this->tour = new Tour();
    }

    // Hiển thị danh sách tour
    public function danhSachTour()
    {
        $tours = $this->tour->getAll();
        $stats = $this->tour->getStatistics();
        require_once './views/tour/list.php';
    }
    
    // Hiển thị form thêm tour
    public function formAdd()
    {
        require_once './views/tour/add.php';
    }

    // Xử lý thêm tour
    public function add()
    {
        // Lấy dữ liệu từ form
        $data = [];
        $data['ten_tour'] = $_POST['ten_tour'] ?? '';
        $data['loai_tour'] = $_POST['loai_tour'] ?? 'NOI_DIA';
        $data['mo_ta'] = $_POST['mo_ta'] ?? '';
        $data['gia_tour'] = $_POST['gia_tour'] ?? 0;
        $data['chinh_sach'] = $_POST['chinh_sach'] ?? '';
        $data['trang_thai'] = isset($_POST['trang_thai']) ? 1 : 0;

        // Xử lý ảnh nếu có
        $uploadDir = __DIR__ . '/../assets/img/tours/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        $hinh = '';
        // Ưu tiên URL ảnh nếu có
        if (!empty($_POST['hinh_anh_url'])) {
            $hinh = $_POST['hinh_anh_url'];
        } elseif (!empty($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === UPLOAD_ERR_OK) {
            // Nếu không có URL, thử upload file
            $tmpName = $_FILES['hinh_anh']['tmp_name'];
            $original = basename($_FILES['hinh_anh']['name']);
            $ext = pathinfo($original, PATHINFO_EXTENSION);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', pathinfo($original, PATHINFO_FILENAME)) . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($tmpName, $dest)) {
                $hinh = $filename;
            }
        }

        $data['hinh_anh'] = $hinh;

        $this->tour->add($data);
        header('Location: ?act=tour');
        exit;
    }

    // Hiển thị form sửa tour
    public function formEdit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?act=tour');
            exit;
        }
        $tour = $this->tour->getById($id);
        require_once './views/tour/edit.php';
    }

    // Xử lý cập nhật tour
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?act=tour');
            exit;
        }

        $data = [];
        $data['ten_tour'] = $_POST['ten_tour'] ?? '';
        $data['loai_tour'] = $_POST['loai_tour'] ?? 'NOI_DIA';
        $data['mo_ta'] = $_POST['mo_ta'] ?? '';
        $data['gia_tour'] = $_POST['gia_tour'] ?? 0;
        $data['chinh_sach'] = $_POST['chinh_sach'] ?? '';
        $data['trang_thai'] = isset($_POST['trang_thai']) ? 1 : 0;

        // Xử lý ảnh mới nếu có, nếu không giữ nguyên ảnh cũ
        $uploadDir = __DIR__ . '/../assets/img/tours/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        $hinh = '';
        // Ưu tiên URL ảnh mới nếu có
        if (!empty($_POST['hinh_anh_url'])) {
            $hinh = $_POST['hinh_anh_url'];
        } elseif (!empty($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === UPLOAD_ERR_OK) {
            // Nếu không có URL, thử upload file mới
            $tmpName = $_FILES['hinh_anh']['tmp_name'];
            $original = basename($_FILES['hinh_anh']['name']);
            $ext = pathinfo($original, PATHINFO_EXTENSION);
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', pathinfo($original, PATHINFO_FILENAME)) . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($tmpName, $dest)) {
                $hinh = $filename;
            }
        }

        // Nếu không có ảnh mới, giữ ảnh cũ
        if (empty($hinh)) {
            $old = $this->tour->getById($id);
            $hinh = $old['hinh_anh'] ?? '';
        }

        $data['hinh_anh'] = $hinh;

        $this->tour->update($id, $data);
        header('Location: ?act=tour');
        exit;
    }

    // Xóa tour
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->tour->delete($id);
        }
        header('Location: ?act=tour');
        exit;
    }

    // Xem chi tiết tour
    public function viewTour()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?act=tour');
            exit;
        }
        $tour = $this->tour->getById($id);
        // Có thể lấy thêm lịch trình/chi phí nếu cần
        require_once './views/tour/view.php';
    }
    
}
