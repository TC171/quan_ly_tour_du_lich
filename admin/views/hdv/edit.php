<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa thông tin Hướng Dẫn Viên</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Cập nhật thông tin: <?= htmlspecialchars($hdv['ho_ten']) ?></h3>
                </div>
                <form action="?act=post-edit-hdv" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="hdv_id" value="<?= $hdv['hdv_id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $hdv['user_id'] ?>">
                        <input type="hidden" name="anh_cu" value="<?= $hdv['anh'] ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-primary border-bottom pb-2">1. Thông tin tài khoản</h4>
                                
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input type="text" class="form-control" name="ho_ten" 
                                           value="<?= htmlspecialchars($hdv['ho_ten']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Email (Tài khoản)</label>
                                    <input type="email" class="form-control" name="email" 
                                           value="<?= htmlspecialchars($hdv['email']) ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="dien_thoai" 
                                           value="<?= htmlspecialchars($hdv['dien_thoai']) ?>" required>
                                </div>
                                
                                <div class="alert alert-info mt-4">
                                    <i class="fas fa-info-circle"></i> Mật khẩu không được hiển thị ở đây vì lý do bảo mật.
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h4 class="text-primary border-bottom pb-2">2. Thông tin nghề nghiệp</h4>
                                
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input type="date" class="form-control" name="ngay_sinh" 
                                           value="<?= $hdv['ngay_sinh'] ?>">
                                </div>

                                <div class="form-group">
                                    <label>Ảnh đại diện hiện tại</label>
                                    <div class="mb-2">
                                        <img src="<?= BASE_URL_HDV . $hdv['anh'] ?>" style="width: 150px; height: auto; border: 1px solid #ccc; padding: 3px;" alt="Ảnh HDV">
                                    </div>
                                    <label>Chọn ảnh mới (Nếu muốn thay đổi)</label>
                                    <input type="file" class="form-control" name="anh">
                                </div>

                                <div class="form-group">
                                    <label>Chuyên môn</label>
                                    <input type="text" class="form-control" name="chuyen_mon" 
                                           value="<?= htmlspecialchars($hdv['chuyen_mon']) ?>">
                                </div>

                                <div class="form-group">
                                    <label>Ngôn ngữ</label>
                                    <input type="text" class="form-control" name="ngon_ngu" 
                                           value="<?= htmlspecialchars($hdv['ngon_ngu']) ?>">
                                </div>

                                <div class="form-group">
                                    <label>Kinh nghiệm</label>
                                    <input type="text" class="form-control" name="kinh_nghiem" 
                                           value="<?= htmlspecialchars($hdv['kinh_nghiem']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Lưu thay đổi</button>
                        <a href="?act=huong_dan_vien" class="btn btn-secondary float-right">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>