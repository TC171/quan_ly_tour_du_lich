<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header"><h1>Phân Công HDV Vào Tour</h1></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="?act=them-phan-bo" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Chọn Tour (*)</label>
                            <select name="tour_id" class="form-control" required>
                                <option value="">-- Chọn Tour --</option>
                                <?php foreach($listTour as $tour): ?>
                                    <option value="<?= $tour['tour_id'] ?>"><?= $tour['ten_tour'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Chọn Hướng Dẫn Viên (*)</label>
                            <select name="hdv_id" class="form-control" required>
                                <option value="">-- Chọn HDV --</option>
                                <?php foreach($listHDV as $hdv): ?>
                                    <option value="<?= $hdv['hdv_id'] ?>"><?= $hdv['ho_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Vai Trò</label>
                            <select name="vai_tro" class="form-control">
                                <option value="HDV chính">HDV chính</option>
                                <option value="HDV phụ">HDV phụ</option>
                                <option value="Thực tập sinh">Thực tập sinh</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Xác Nhận</button>
                        <a href="?act=phan-bo-tour" class="btn btn-default">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php include './views/layout/footer.php'; ?>