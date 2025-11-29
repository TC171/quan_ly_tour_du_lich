<?php
class AdminChiPhiTourController {
    public $modelChiPhi;

    public function __construct() {
        // Khởi tạo Model để tương tác với CSDL
        $this->modelChiPhi = new AdminChiPhiTour();
    }

    // 1. Hiển thị danh sách chi phí (READ)
    public function danhSachChiPhi() {
        $listChiPhi = $this->modelChiPhi->getAllChiPhi();
        // Sử dụng __DIR__ để khắc phục lỗi đường dẫn tuyệt đối
        require_once __DIR__ . '/../views/chiphitour/list_chi_phi.php'; 
    }
    
    // 2. Hiển thị Form THÊM MỚI (CREATE - Form)
    public function formAdd() {
        $listTour = $this->modelChiPhi->getAllTours();
        // Lấy biến lỗi từ session (nếu có)
        $error_message = $_SESSION['add_error'] ?? null;
        unset($_SESSION['add_error']); // Xóa lỗi sau khi hiển thị

        // Hiển thị form thêm mới
        require_once __DIR__ . '/../views/chiphitour/add_chi_phi.php'; 
    }

    // 3. Xử lý dữ liệu THÊM MỚI (CREATE - Post)
    public function postAdd() {
        // session_start() đã có ở index.php nên không cần gọi lại ở đây
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_id = $_POST['tour_id'] ?? null;
            $loai_chi_phi = $_POST['loai_chi_phi'] ?? '';
            $so_tien = $_POST['so_tien'] ?? 0;
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $ngay_phat_sinh = $_POST['ngay_phat_sinh'] ?? date('Y-m-d'); 
            
            // Kiểm tra dữ liệu bắt buộc
            if ($tour_id !== null && $so_tien > 0 && !empty($loai_chi_phi)) {
                $result = $this->modelChiPhi->addChiPhi($tour_id, $loai_chi_phi, $so_tien, $ghi_chu, $ngay_phat_sinh);
                
                if ($result) {
                    // Thành công: Chuyển hướng về trang danh sách
                    header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
                    exit(); // QUAN TRỌNG: Dừng thực thi code
                } else {
                    $_SESSION['add_error'] = "Lỗi hệ thống: Không thể thêm chi phí vào CSDL.";
                }
            } else {
                $_SESSION['add_error'] = "Lỗi: Vui lòng nhập đầy đủ thông tin bắt buộc (Tour, Loại chi phí, Số tiền).";
            }
            
            // LỖI ĐÃ SỬA: Chuyển hướng về Form Add với action đúng
            header("Location: " . BASE_URL_ADMIN . '?act=form-them-chi-phi'); 
            exit(); // Dừng thực thi code

        } else {
            // Nếu không phải POST request, chuyển hướng về danh sách
            header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
            exit();
        }
    }
    
    // 4. THAO TÁC XEM CHI TIẾT (READ - Detail)
    public function detailChiPhi() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $chiPhi = $this->modelChiPhi->getDetailChiPhi($id);

            if ($chiPhi) {
                require_once __DIR__ . '/../views/chiphitour/detail_chi_phi.php';
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
                exit();
            }
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
            exit();
        }
    }

    // 5. Xóa chi phí (DELETE)
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelChiPhi->deleteChiPhi($id);
        }
        header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
        exit();
    }

    // 6. Hiển thị Form sửa (UPDATE - Form)
    public function formEdit() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $chiPhi = $this->modelChiPhi->getDetailChiPhi($id);
            $listTour = $this->modelChiPhi->getAllTours(); 

            if ($chiPhi) {
                require_once __DIR__ . '/../views/chiphitour/edit_chi_phi.php';
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
                exit();
            }
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
            exit();
        }
    }

    // 7. Xử lý dữ liệu khi người dùng bấm nút "Cập nhật" (UPDATE - Post)
    public function postEdit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['chiphi_id'] ?? null;
            $tour_id = $_POST['tour_id'] ?? null;
            $loai_chi_phi = $_POST['loai_chi_phi'] ?? '';
            $so_tien = $_POST['so_tien'] ?? 0;
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $ngay_phat_sinh = $_POST['ngay_phat_sinh'] ?? null;

            if ($id) {
                $this->modelChiPhi->updateChiPhi($id, $tour_id, $loai_chi_phi, $so_tien, $ghi_chu, $ngay_phat_sinh);
            }
            
            header("Location: " . BASE_URL_ADMIN . '?act=chi_phi_tour');
            exit();
        }
    }
}