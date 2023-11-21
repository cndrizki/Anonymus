<?php
    include '../config/koneksi.php';

    session_start();

    $sql_setting = 'SELECT * FROM settings';
    $result_setting = mysqli_query($koneksi, $sql_setting);
    $setting = mysqli_fetch_assoc($result_setting);

    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    if ($_SESSION['login_admin'] <> true) {
        echo "<script>
            alert('Anda harus login terlebih dahulu.');
            window.location.href='../index.php?p=login';
        </script>";
    }

    if (isset($_GET['logout'])) {
        unset($_SESSION['login_admin']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_id']);

        echo "<script>
            alert('Anda telah logout.');
            window.location.href='../index.php?p=login';
        </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $setting['nama_website'] ?></title>

    <!-- Favicon -->
    <link href="<?= '../'.$setting['favicon'] ?>" rel="icon">
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="../assets/admin/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../assets/admin/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/admin/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="../assets/admin/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/admin/css/style.css">
    <link rel="stylesheet" href="../assets/admin/css/components.css">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../images/user.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['admin_name'] ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="index.php?logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.php">
                            <p><?= $setting['nama_website'] ?></p>
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.php"><?= $setting['nama_website'] ?></a>
                    </div>
                    <ul class="sidebar-menu">
                        
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="index.php"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
                        <li><a href="index.php?a=pengguna" class="nav-link"><i class="fas fa-users"></i> <span>Pengguna</span></a></li>
                        <li><a class="nav-link" href="index.php?a=administrator"><i class="fas fa-users"></i> <span>Administrator</span></a></li>
                        
                        <li><a href="index.php?a=setting" class="nav-link"><i class="fas ion-ios-gear"></i> <span>Setting Website</span></a></li>

                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="index.php?logout" class="btn btn-danger btn-lg btn-block btn-icon-split">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                    </div>
                </aside>
            </div>


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">

                    <?php
                        if (isset($_GET['a'])=='') {
                            include 'dashboard/index.php';
                        } elseif ($_GET['a']=='pengguna') {
                            include 'pengguna/index.php';
                        } elseif ($_GET['a']=='administrator') {
                            include 'administrator/index.php';
                        } elseif ($_GET['a']=='administratoradd') {
                            include 'administrator/add.php';
                        } elseif ($_GET['a']=='administratoredit') {
                            include 'administrator/edit.php';
                        } elseif ($_GET['a']=='setting') {
                            include 'setting/index.php';
                        } elseif ($_GET['a']=='settingedit') {
                            include 'setting/edit.php';
                        }
                    ?>

                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date('Y') ?> <div class="bullet"></div> <?= $setting['nama_website'] ?>
                </div>
                <div class="footer-right">

                </div>
            </footer>

        </div>
    </div>

    <!-- General JS Scripts -->
<script src="../assets/admin/modules/jquery.min.js"></script>
<script src="../assets/admin/modules/popper.js"></script>
<script src="../assets/admin/modules/tooltip.js"></script>
<script src="../assets/admin/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="../assets/admin/modules/moment.min.js"></script>
<script src="../assets/admin/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="../assets/admin/modules/cleave-js/dist/cleave.min.js"></script>
<script src="../assets/admin/modules/jquery.sparkline.min.js"></script>
<script src="../assets/admin/modules/chart.min.js"></script>
<script src="../assets/admin/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="../assets/admin/modules/summernote/summernote-bs4.js"></script>
<script src="../assets/admin/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<script src="../assets/admin/modules/izitoast/js/iziToast.min.js"></script>
<script src="../assets/admin/modules/datatables/datatables.min.js"></script>
<script src="../assets/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="../assets/admin/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="../assets/admin/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="../assets/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

<!-- Page Specific JS File -->
<script src="../assets/admin/js/page/index.js"></script>
<script src="../assets/admin/js/page/features-post-create.js"></script>

<!-- Template JS File -->
<script src="../assets/admin/js/scripts.js"></script>
<script src="../assets/admin/js/custom.js"></script>
<script>
    $('#table-1').DataTable();
</script>

</body>

</html>
