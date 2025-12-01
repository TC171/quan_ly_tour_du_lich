    <?php
class AdminLichTrinhController {
    public $modelLichTrinh;
    public $modelTour;

   public function __construct() {
    // Khởi tạo Model
    $this->modelLichTrinh = new AdminLichTrinhTour();
    $this->modelTour = new Tour(); // <--- Sửa 'AdminTour' thành 'Tour'
}

    // 1. Hiển thị danh sách lịch trình
    public function index() {
        $listLichTrinh = $this->modelLichTrinh->getAll();
        require_once './views/lich_trinh/list.php'; 
    }

    // 2. Form thêm mới
    public function formAdd() {
        // Lấy danh sách tour để chọn trong dropdown
        $tours = $this->modelTour->getAll(); 
        require_once './views/lich_trinh/add.php'; 
    }

    // 3. Xử lý thêm mới
    public function postAdd() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'tour_id' => $_POST['tour_id'],
                'ngay_thu' => $_POST['ngay_thu'],
                'diem_tham_quan' => $_POST['diem_tham_quan'],
                'thoi_gian' => $_POST['thoi_gian'],
                'mo_ta' => $_POST['mo_ta']
            ];
            
            $this->modelLichTrinh->insert($data);
            header("Location: ?act=hanh_trinh");
        }
    }

    // 4. Xóa
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelLichTrinh->delete($id);
        }
        header("Location: ?act=hanh_trinh");
    }
}
?>