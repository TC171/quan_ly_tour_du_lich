<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <!-- Icon Menu → vali kéo -->
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-suitcase-rolling"></i>
            </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= BASE_URL ?>" class="nav-link">Website</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Fullscreen → icon địa cầu -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-globe-asia"></i>
            </a>
        </li>

        <!-- Logout → icon đẹp hơn -->
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL_ADMIN . '?act=logout-admin' ?>"
               onclick="return confirm('Đăng Xuất Tài Khoản')">
                <i class="fas fa-door-open"></i>
            </a>
        </li>

    </ul>
</nav>
