<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Hướng Dẫn Viên</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách HDV</h3>
                    <a href="?act=form-add-hdv" class="btn btn-success float-right">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th>Họ Tên (User)</th>
                                <th class="text-center">Ảnh</th>
                                <th>Chuyên môn</th>
                                <th>Ngôn ngữ</th>
                                <th>Kinh nghiệm</th>
                                <th>Điện thoại</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listHdv as $key => $hdv): ?>
                            <tr>
                                <td class="text-center"><?= $key + 1 ?></td>
                                <td>
                                    <b><?= $hdv['ho_ten'] ?></b><br>
                                    <small class="text-muted"><?= $hdv['email'] ?></small>
                                </td>
                                
                                <td class="text-center">
                                    <?php if (!empty($hdv['anh'])): ?>
                                        <img src="<?= BASE_URL_HDV . $hdv['anh'] ?>" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px; border: 1px solid #ccc;" 
                                             alt="Ảnh HDV"
                                             onerror="this.onerror=null; this.src='<?= BASE_URL_ADMIN ?>assets/dist/img/default-150x150.png'">
                                    <?php else: ?>
                                        <img src="<?= BASE_URL_ADMIN ?>assets/dist/img/default-150x150.png" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px; opacity: 0.6;" 
                                             alt="Chưa có ảnh">
                                    <?php endif; ?>
                                </td>
                                <td><?= $hdv['chuyen_mon'] ?></td>
                                <td><?= $hdv['ngon_ngu'] ?></td>
                                <td><?= $hdv['kinh_nghiem'] ?></td>
                                <td><?= $hdv['dien_thoai'] ?></td>
                                <td class="text-center">
                                    <a href="?act=form-edit-hdv&id=<?= $hdv['hdv_id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="?act=delete-hdv&id=<?= $hdv['hdv_id'] ?>" 
                                       onclick="return confirm('Bạn có chắc muốn xóa HDV này và tài khoản liên quan?')" 
                                       class="btn btn-danger btn-sm">
                                       <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>