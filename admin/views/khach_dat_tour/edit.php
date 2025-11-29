<?php 
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/navbar.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật thông tin khách hàng</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-khach' ?>" method="POST">
                        <input type="hidden" name="khach_id" value="<?= $khach['khach_id'] ?>">
                        
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin khách hàng: <?= $khach['ho_ten'] ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text" class="form-control" name="ho_ten" value="<?= $khach['ho_ten'] ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Giới tính</label>
                                            <select name="gioi_tinh" class="form-control">
                                                <option value="NAM" <?= $khach['gioi_tinh'] == 'NAM' ? 'selected' : '' ?>>Nam</option>
                                                <option value="NU" <?= $khach['gioi_tinh'] == 'NU' ? 'selected' : '' ?>>Nữ</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Năm sinh</label>
                                            <input type="number" class="form-control" name="nam_sinh" value="<?= $khach['nam_sinh'] ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CMND / Passport</label>
                                            <input type="text" class="form-control" name="cmnd_passport" value="<?= $khach['cmnd_passport'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Yêu cầu đặc biệt</label>
                                            <textarea class="form-control" name="yeu_cau_dac_biet" rows="3"><?= $khach['yeu_cau_dac_biet'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                <a href="<?= BASE_URL_ADMIN . '?act=khach-dat-tour' ?>" class="btn btn-secondary">Hủy</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>