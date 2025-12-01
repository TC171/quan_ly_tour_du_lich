<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Quản Lý Phân Bổ HDV</h1></div>
                <div class="col-sm-6 text-right">
                    <a href="?act=form-them-phan-bo" class="btn btn-primary"><i class="fas fa-plus"></i> Phân công mới</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Danh sách HDV đang phụ trách Tour</h3></div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Tour</th>
                                <th>Tên HDV</th>
                                <th>Vai Trò</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listPhanBo as $key => $pb): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $pb['ten_tour'] ?></td>
                                    <td class="font-weight-bold text-primary"><?= $pb['ten_hdv'] ?></td>
                                    <td>
                                        <span class="badge <?= $pb['vai_tro'] == 'HDV chính' ? 'badge-success' : 'badge-secondary' ?>">
                                            <?= $pb['vai_tro'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="?act=xoa-phan-bo&id=<?= $pb['phanbo_id'] ?>" 
                                           onclick="return confirm('Hủy phân công này?')" 
                                           class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</a>
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