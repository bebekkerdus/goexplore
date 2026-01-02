<?php
require_once '../../fungsi/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

$user = query("SELECT * FROM user WHERE user_id = {$_SESSION['user_id']}")[0];

if ($user['role'] !== 'admin') {
    header('Location: ../../index.php');
    exit;
}

$a = $active ?? '';
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">E-Tourism Admin</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">     
                <li><a class="dropdown-item" href="../user/profile.php">profile</a></li>        
                <li><a class="dropdown-item" href="../../fungsi/logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link <?php echo $a === 'dashboard' ? 'active' : ''; ?>" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Management</div>
                    <a class="nav-link <?php echo $a === 'users' ? 'active' : ''; ?>" href="users.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Users
                    </a>
                    <a class="nav-link <?php echo $a === 'hotels' ? 'active' : ''; ?>" href="hotels.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                        Hotels
                    </a>
                    <a class="nav-link <?php echo $a === 'destinasi' ? 'active' : ''; ?>" href="destinasi.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-map-location-dot"></i></div>
                        Destinasi
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Admin
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
