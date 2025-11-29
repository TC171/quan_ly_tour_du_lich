<?php 
    // Các biến cần thiết: $listTour (danh sách tour) được truyền từ Controller qua hàm formAdd()
    // Giả định bạn có biến BASE_URL_ADMIN
?>

<?php include __DIR__ . '/../layout/header.php'; ?>
<?php include __DIR__ . '/../layout/navbar.php'; ?>
<?php include __DIR__ . '/../layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm Chi Phí Tour Mới</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Nhập thông tin chi phí</h3>
                        </div>
                        
                        <form action="<?= BASE_URL_ADMIN . '?act=postAdd' ?>" method="POST">
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="tour_id">Chọn Tour Áp dụng (*)</label>
                                    <select name="tour_id" id="tour_id" class="form-control" required>
                                        <option value="">-- Chọn Tour --</option>
                                        <?php 
                                            // Kiểm tra và lặp qua danh sách tour (listTour) được truyền từ Controller
                                            if (isset($listTour) && is_array($listTour)): 
                                                foreach ($listTour as $tour): 
                                        ?>
                                            <option value="<?= $tour['tour_id'] ?>">
                                                <?= htmlspecialchars($tour['ten_tour']) ?>
                                            </option>
                                        <?php 
                                                endforeach; 
                                            endif;
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="loai_chi_phi">Loại Chi Phí (*)</label>
                                    <select name="loai_chi_phi" id="loai_chi_phi" class="form-control" required>
                                        <option value="">-- Chọn loại --</option>
                                        <option value="Khách sạn">Khách sạn</option>
                                        <option value="Vận chuyển">Vận chuyển</option>
                                        <option value="Ăn uống">Ăn uống</option>
                                        <option value="Vé tham quan">Vé tham quan</option>
                                        <option value="Khác">Khác</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="so_tien">Số Tiền (VNĐ) (*)</label>
                                    <input type="number" name="so_tien" id="so_tien" class="form-control" placeholder="Nhập số tiền" required min="1000">
                                </div>

                                <div class="form-group">
                                    <label for="ngay_phat_sinh">Ngày Phát Sinh (*)</label>
                                    <input type="date" name="ngay_phat_sinh" id="ngay_phat_sinh" class="form-control" value="<?= date('Y-m-d') ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="ghi_chu">Ghi Chú</label>
                                    <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="3" placeholder="Chi tiết chi phí..."></textarea>
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Thêm Chi Phí</button>
                                <a href="<?= BASE_URL_ADMIN . '?act=chi_phi_tour' ?>" class="btn btn-default">Quay lại</a>
                            </div>
                        </form>
                    </div>
                    </div>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>