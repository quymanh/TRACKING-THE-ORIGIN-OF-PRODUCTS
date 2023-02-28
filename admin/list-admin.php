<?php 
    if ($_SESSION['role'] !== '0' && $_SESSION['role'] !== '1'){
        header('location: '.BASE_URL);
        ob_end_flush();
        session_unset();
        session_destroy();
        exit;
    }
?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=BASE_URL?>" style="background-color: #f1f8ff;">
            <div class="sidebar-brand-icon">
                <img src="<?=BASE_URL?>img/overlays/logo.png" class="w-25 img-thumbnail m-auto img-fluid d-block m-3 border-0 rounded bg-transparent">
            </div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Trang chủ
        </div>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?=BASE_URL?>admin/index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Trang chủ</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Bài viết
        </div>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?=BASE_URL?>admin/bai-viet.php">
            <i class="fas fa-file-alt"></i>
                <span>Bài viết</span></a>
        </li>
    </ul>
<!-- End of Sidebar -->