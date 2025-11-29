<?php 
include './views/layout/header.php'; 
include './views/layout/navbar.php'; 
include './views/layout/sidebar.php'; 
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Thêm Tour</h1>
        </div>
        <div class="col-sm-6 text-end">
          <a href="?act=tour" class="btn btn-secondary">Quay lại</a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Thêm Tour Mới</h3>
        </div>
        <form action="?act=add-tour-save" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <!-- Cột trái: Thông tin cơ bản -->
              <div class="col-md-6">
                <h5 class="mb-3"><i class="fas fa-info-circle"></i> Thông Tin Cơ Bản</h5>
                
                <div class="mb-3">
                  <label class="form-label"><strong>Tên tour</strong> <span class="text-danger">*</span></label>
                  <input type="text" name="ten_tour" class="form-control" placeholder="Nhập tên tour" required>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label"><strong>Loại tour</strong></label>
                      <select name="loai_tour" class="form-control">
                        <option value="NOI_DIA">Nội địa</option>
                        <option value="QUOC_TE">Quốc tế</option>
                        <option value="THEO_YEU_CAU">Theo yêu cầu</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label"><strong>Giá tour (VND)</strong> <span class="text-danger">*</span></label>
                      <input type="number" name="gia_tour" class="form-control" placeholder="0" step="0.01" required>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label"><strong>Mô tả</strong></label>
                  <textarea name="mo_ta" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết về tour"></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label"><strong>Chính sách</strong></label>
                  <textarea name="chinh_sach" class="form-control" rows="3" placeholder="Nhập chính sách hoàn tiền, hủy tour..."></textarea>
                </div>
              </div>

              <!-- Cột phải: Ảnh và trạng thái -->
              <div class="col-md-6">
                <h5 class="mb-3"><i class="fas fa-image"></i> Ảnh & Trạng Thái</h5>
                
                <div class="mb-3">
                  <label class="form-label"><strong>Ảnh đại diện</strong></label>
                  <div class="card bg-light border-dashed">
                    <div class="card-body p-3">
                      <input type="file" name="hinh_anh" class="form-control" accept="image/*">
                      <small class="text-muted d-block mt-2">Định dạng: JPG, PNG, GIF (tối đa 5MB)</small>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label"><strong>Hoặc nhập link ảnh</strong></label>
                  <input type="url" name="hinh_anh_url" class="form-control" placeholder="https://example.com/image.jpg">
                  <small class="text-muted d-block mt-1">Ưu tiên URL nếu nhập cả file và link</small>
                </div>

                <div class="mb-3">
                  <label class="form-label"><strong>Trạng thái</strong></label>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="trang_thai" id="trang_thai" checked>
                    <label class="form-check-label" for="trang_thai">
                      <span id="status-text" class="badge bg-success">Đang bán</span>
                    </label>
                  </div>
                  <small class="text-muted d-block mt-2">Bật: Đang bán | Tắt: Tạm ngưng</small>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer text-end">
            <a href="?act=tour" class="btn btn-secondary me-2">
              <i class="fas fa-times"></i> Hủy
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Lưu Tour
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<?php include './views/layout/footer.php'; ?>
