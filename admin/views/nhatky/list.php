<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Quản lý Nhật Ký Tour (Báo cáo HDV)</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách nhật ký</h3>
                </div>
                
                <div class="card-body border-bottom">
                    <form action="" method="GET">
                        <input type="hidden" name="act" value="cham_cong_hdv">
                        
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold">Tour:</label>
                                    <select name="tour_id" class="form-control" 
                                            onchange="document.getElementsByName('ngay')[0].value=''; this.form.submit()">
                                        <option value="">-- Tất cả Tour --</option>
                                        <?php foreach ($listTourFilter as $t): ?>
                                            <option value="<?= $t['tour_id'] ?>" 
                                                <?= (isset($_GET['tour_id']) && $_GET['tour_id'] == $t['tour_id']) ? 'selected' : '' ?>>
                                                <?= $t['ten_tour'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold">Ngày:</label>
                                    <select name="ngay" class="form-control" onchange="this.form.submit()">
                                        <option value="">-- Tất cả Ngày --</option>
                                        <?php foreach ($listDateFilter as $d): ?>
                                            <option value="<?= $d['ngay'] ?>"
                                                <?= (isset($_GET['ngay']) && $_GET['ngay'] == $d['ngay']) ? 'selected' : '' ?>>
                                                <?= date('d/m/Y', strtotime($d['ngay'])) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Lọc dữ liệu
                                    </button>
                                    
                                    <a href="?act=cham_cong_hdv" class="btn btn-secondary ml-2">
                                        <i class="fas fa-undo"></i> Đặt lại
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Tour</th>
                                <th>HDV Phụ Trách</th>
                                <th>Ngày</th>
                                <th>Hình ảnh</th>
                                <th>Ghi chú / Báo cáo</th>
                                <th>Trạng thái</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($listNhatKy) > 0): ?>
                                <?php foreach ($listNhatKy as $key => $row): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $row['ten_tour'] ?></td>
                                    <td><b><?= $row['ho_ten'] ?></b></td>
                                    <td><?= date('d/m/Y', strtotime($row['ngay'])) ?></td>
                                    <td>
                                        <?php if (!empty($row['hinh_anh'])): ?>
                                            <img src="<?= BASE_URL_HDV . $row['hinh_anh'] ?>" style="width: 80px; height: 60px; object-fit: cover; border: 1px solid #ddd;" alt="Ảnh">
                                        <?php else: ?>
                                            <span class="text-muted">Không có ảnh</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['ghi_chu'] ?></td>
                                    <td>
                                        <?php if(isset($row['trang_thai'])): ?>
                                            <?php if($row['trang_thai'] == 1): ?>
                                                <span class="badge badge-success">Đã duyệt</span>
                                            <?php elseif($row['trang_thai'] == 2): ?>
                                                <span class="badge badge-danger">Không duyệt</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Chờ duyệt</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-danger">Không tìm thấy nhật ký nào!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>