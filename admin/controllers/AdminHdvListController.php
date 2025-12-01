<?php
class AdminHdvListController {
    public $model;

    public function __construct() {
        $this->model = new AdminHdvList();
    }

    public function danhSach() {
        $listHdv = $this->model->getAll();
        require_once './views/hdv/list.php';
    }

    public function formAdd() {
        require_once './views/hdv/add.php';
    }

    public function postAdd() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dien_thoai = $_POST['dien_thoai'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $chuyen_mon = $_POST['chuyen_mon'];
            $ngon_ngu = $_POST['ngon_ngu'];
            $kinh_nghiem = $_POST['kinh_nghiem'];

            // Xử lý ảnh
            $anh = '';
            if (isset($_FILES['anh']) && $_FILES['anh']['size'] > 0) {
                // Giữ nguyên dấu / ở đầu để tránh lỗi đường dẫn
                $anh = uploadFile($_FILES['anh'], '/uploads/hdv/');
            }

            // Gọi Model thêm mới
            if ($this->model->insert($ho_ten, $email, $password, $dien_thoai, $ngay_sinh, $anh, $chuyen_mon, $ngon_ngu, $kinh_nghiem)) {
                // Thành công -> Về trang danh sách
                header("Location: ?act=huong_dan_vien");
            } else {
                // Thất bại
                echo "<h3 style='color:red'>Lỗi thêm mới!</h3>";
                echo "<p>Có thể Email <b>$email</b> đã tồn tại trong hệ thống. Hãy thử email khác.</p>";
            }
        }
    }

   public function formEdit() {
        $id = $_GET['id'];
        $hdv = $this->model->getDetail($id);
        require_once './views/hdv/edit.php';
    }

    public function postEdit() {
      
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 1. Lấy dữ liệu văn bản
            $hdv_id = $_POST['hdv_id'];
            $user_id = $_POST['user_id'];
            $ho_ten = $_POST['ho_ten'];
            $dien_thoai = $_POST['dien_thoai'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $chuyen_mon = $_POST['chuyen_mon'];
            $ngon_ngu = $_POST['ngon_ngu'];
            $kinh_nghiem = $_POST['kinh_nghiem'];

            // 2. Xử lý ảnh (Logic quan trọng)
            
            // Mặc định lấy ảnh cũ từ input hidden 'anh_cu'
            $anh = $_POST['anh_cu']; 

            // Kiểm tra nếu người dùng có chọn file ảnh mới
            $file_anh = $_FILES['anh'];
            if (isset($file_anh) && $file_anh['size'] > 0) {
                
                // Upload ảnh mới vào thư mục uploads/hdv/
                $uploadResult = uploadFile($file_anh, '/uploads/hdv/');
                
                // Nếu upload thành công thì mới gán đường dẫn mới
                if ($uploadResult) {
                    $anh = $uploadResult;
                }
            }

            // 3. Gọi Model update
            $this->model->update($hdv_id, $user_id, $ho_ten, $dien_thoai, $ngay_sinh, $anh, $chuyen_mon, $ngon_ngu, $kinh_nghiem);
            
            // 4. Quay về danh sách
            header("Location: ?act=huong_dan_vien");
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header("Location: ?act=huong_dan_vien");
    }
}
