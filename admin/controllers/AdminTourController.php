<?php
class AdminTourController
{
    public $modelTour;

    public function __construct()
    {
        $this->modelTour = new Tour(); // Khởi tạo Model
    }

    // 1. Hiển thị danh sách (Đã có)
    public function danhSachTour()
    {
        $tours = $this->modelTour->getAll();
        require_once './views/tour/list.php';
    }

    // 2. Hiển thị Form Thêm mới
    public function formAddTour()
    {
        // Hiển thị view thêm mới
        require_once './views/tour/add.php'; // Bạn cần tạo file view này
    }

    // 3. Xử lý Thêm mới (POST)
    public function postAddTour()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ten_tour = $_POST['ten_tour'];
            $loai_tour = $_POST['loai_tour'];
            $mo_ta = $_POST['mo_ta'];
            $gia_tour = $_POST['gia_tour'];
            $chinh_sach = $_POST['chinh_sach'];
            $trang_thai = $_POST['trang_thai'];

            // Xử lý upload ảnh
            $hinh_anh = '';
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
                $file = $_FILES['hinh_anh'];
                $path = './assets/uploads/'; // Thư mục lưu ảnh
                if (!is_dir($path)) mkdir($path); // Tạo thư mục nếu chưa có
                
                $fileName = time() . '_' . $file['name'];
                move_uploaded_file($file['tmp_name'], $path . $fileName);
                $hinh_anh = $fileName;
            }

            // Gọi model để thêm
            $data = [
                'ten_tour' => $ten_tour,
                'loai_tour' => $loai_tour,
                'mo_ta' => $mo_ta,
                'gia_tour' => $gia_tour,
                'hinh_anh' => $hinh_anh,
                'chinh_sach' => $chinh_sach,
                'trang_thai' => $trang_thai
            ];

            $this->modelTour->add($data);

            // Quay về danh sách
            header("Location: ?act=tour");
        }
    }

    // 4. Hiển thị Form Sửa
    public function formEditTour()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $tour = $this->modelTour->getById($id);
            if ($tour) {
                require_once './views/tour/edit.php'; // Bạn cần tạo file view này
            } else {
                header("Location: ?act=tour");
            }
        }
    }

    // 5. Xử lý Cập nhật (POST)
    public function postEditTour()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['tour_id'];
            
            // Lấy thông tin cũ để giữ lại ảnh nếu không up ảnh mới
            $tourOld = $this->modelTour->getById($id);
            $hinh_anh = $tourOld['hinh_anh'];

            // Xử lý ảnh mới (nếu có)
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
                $file = $_FILES['hinh_anh'];
                $path = './assets/uploads/';
                $fileName = time() . '_' . $file['name'];
                move_uploaded_file($file['tmp_name'], $path . $fileName);
                $hinh_anh = $fileName;
            }

            $data = [
                'ten_tour' => $_POST['ten_tour'],
                'loai_tour' => $_POST['loai_tour'],
                'mo_ta' => $_POST['mo_ta'],
                'gia_tour' => $_POST['gia_tour'],
                'hinh_anh' => $hinh_anh,
                'chinh_sach' => $_POST['chinh_sach'],
                'trang_thai' => $_POST['trang_thai']
            ];

            $this->modelTour->update($id, $data);
            header("Location: ?act=tour");
        }
    }

    // 6. Xóa Tour
    public function deleteTour()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelTour->delete($id);
        }
        header("Location: ?act=tour");
    }
}
?>