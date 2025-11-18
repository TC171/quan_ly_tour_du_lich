<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="login-page">

<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <b>Đăng Nhập Hệ Thống</b>
    </div>
    <div class="card-body">

      <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
      <?php endif; ?>

      <form action="xuly_login.php" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>

        <button class="btn btn-primary btn-block">Đăng nhập</button>
      </form>

    </div>
  </div>
</div>

</body>
</html>
