<?php
class AdminChiPhiTourController {
    public $modelChiPhi;

    public function __construct() {
        $this->modelChiPhi = new AdminChiPhiTour();
    }

    // 1. Hiển thị danh sách chi phí
    public function danhSachChiPhi() {
        // Lấy dữ liệu từ Model
        $listChiPhi = $this->modelChiPhi->getAllChiPhi();

        // Gọi View để hiển thị
        require_once './views/chiphi/list_chi_phi.php';
    }

    // 2. Xóa chi phí
    public function delete() {
        // Lấy ID từ URL, dùng ?? null để tránh lỗi nếu không có ID
        $id = $_GET['id'] ?? null;
        
        // Chỉ gọi Model xóa khi có ID hợp lệ
        if ($id) {
            $this->modelChiPhi->deleteChiPhi($id);
        }
        
        // Xóa xong (hoặc không có ID) thì quay về trang danh sách
        header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
        exit();
    }

    // 3. Hiển thị Form sửa (Lấy dữ liệu cũ đổ vào form)
    public function formEdit() {
        // Lấy ID từ URL
        $id = $_GET['id'] ?? null;
        
        // Nếu có ID thì mới xử lý
        if ($id) {
            // Lấy thông tin chi tiết
            $chiPhi = $this->modelChiPhi->getDetailChiPhi($id);
            
            // Lấy danh sách tour để chọn lại (nếu cần)
            $listTour = $this->modelChiPhi->getAllTours();

            if ($chiPhi) {
                // Hiển thị view sửa
                require_once './views/chiphi/edit_chi_phi.php';
            } else {
                // ID có nhưng không tìm thấy dữ liệu -> Quay về
                header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
                exit();
            }
        } else {
            // Không có ID trên URL -> Quay về
            header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
            exit();
        }
    }

    // 4. Xử lý dữ liệu khi người dùng bấm nút "Cập nhật"
    public function postEdit() {
        // Kiểm tra xem người dùng có bấm nút submit (POST) không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $id = $_POST['chiphi_id'] ?? null;
            $tour_id = $_POST['tour_id'] ?? null;
            $loai_chi_phi = $_POST['loai_chi_phi'] ?? '';
            $so_tien = $_POST['so_tien'] ?? 0;
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $ngay_phat_sinh = $_POST['ngay_phat_sinh'] ?? null;

            if ($id) {
                // Gọi model để cập nhật xuống Database
                $this->modelChiPhi->updateChiPhi($id, $tour_id, $loai_chi_phi, $so_tien, $ghi_chu, $ngay_phat_sinh);
            }
            
            // Cập nhật xong thì quay về danh sách
            header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
            exit();
        }
    }
}
?>