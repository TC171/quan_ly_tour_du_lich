<?php include './views/layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-center mb-4 text-uppercase font-weight-bold text-primary">
                <i class="fas fa-map-marked-alt"></i> Tour Của Tôi
            </h3>

            <div class="row">
                <?php if (count($listTours) > 0): ?>
                    <?php foreach ($listTours as $tour): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-0 h-100">
                                <?php if (!empty($tour['hinh_anh'])): ?>
                                    <img src="<?= $tour['hinh_anh'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Ảnh tour">
                                <?php endif; ?>
                                
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-dark">
                                        <?= $tour['ten_tour'] ?>
                                    </h5>
                                    <p class="card-text text-muted mb-2">
                                        <i class="far fa-calendar-alt text-info"></i> 
                                        <?= date('d/m/Y', strtotime($tour['ngay_bat_dau'])) ?> 
                                        <i class="fas fa-arrow-right mx-1"></i> 
                                        <?= date('d/m/Y', strtotime($tour['ngay_ket_thuc'])) ?>
                                    </p>
                                </div>
                                <div class="card-footer bg-white border-0 pb-3">
                                    <a href="?act=hdv-cham-cong&id=<?= $tour['tour_id'] ?>" class="btn btn-primary btn-block rounded-pill">
                                        <i class="fas fa-camera"></i> Vào chấm công / Check-in
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-warning d-inline-block">
                            <i class="fas fa-exclamation-circle"></i> Bạn chưa được phân công Tour nào.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include './views/layout/footer.php'; ?>