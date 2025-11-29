<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới Hướng Dẫn Viên</h3>
                </div>
                <form action="?act=post-add-hdv" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Thông tin tài khoản</h4>
                                <div class="form-group">
                                    <label>Họ tên</label>
                                    <input type="text" class="form-control" name="ho_ten" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="dien_thoai" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h4>Thông tin chi tiết</h4>
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <input type="date" class="form-control" name="ngay_sinh">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <input type="file" class="form-control" name="anh">
                                </div>
                                <div class="form-group">
                                    <label>Chuyên môn</label>
                                    <input type="text" class="form-control" name="chuyen_mon" placeholder="VD: Nội địa, Quốc tế">
                                </div>
                                <div class="form-group">
                                    <label>Ngôn ngữ</label>
                                    <input type="text" class="form-control" name="ngon_ngu" placeholder="VD: Tiếng Anh, Tiếng Nhật">
                                </div>
                                <div class="form-group">
                                    <label>Kinh nghiệm</label>
                                    <input type="text" class="form-control" name="kinh_nghiem" placeholder="VD: 5 năm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="?act=huong_dan_vien" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>