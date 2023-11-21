<?php
    include 'config/koneksi.php';

    session_start();

    $sql_setting = 'SELECT * FROM settings';
    $result_setting = mysqli_query($koneksi, $sql_setting);
    $setting = mysqli_fetch_assoc($result_setting);

    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    if (isset($_GET['logout'])) {
        unset($_SESSION['login_user']);
        unset($_SESSION['user_id']);

        echo "<script>
            alert('Anda telah logout.');
            window.location.href='index.php?p=login';
        </script>";
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $setting['nama_website'] ?></title>

    <link href="<?= $setting['favicon'] ?>" rel="icon">
    
    <!-- CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/281e87e722.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-image: url('<?= $setting['gambar_background'] ?>');
        }
    </style>
    <!-- End CSS -->

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand font-new-rocker text-uppercase" href="index.php"><?= $setting['nama_website'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item text-uppercase">
                        <a class="nav-link font-nerko-one <?php if($uri_segments[3]=='' || $uri_segments[3]=='index.php') { echo 'active'; } ?>" aria-current="page" href="index.php"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <?php
                        if (isset($_SESSION['login_user']) == true) {
                    ?>
                        <li class="nav-item text-uppercase">
                            <a class="nav-link font-nerko-one <?php if(isset($_GET['p'])=='story'){ echo 'active'; }  ?>" aria-current="page" href="index.php?p=story">Story</a>
                        </li>
                        <li class="nav-item text-uppercase">
                            <a class="nav-link font-nerko-one <?php if(isset($_GET['p'])=='mystory'){ echo 'active'; } ?>" aria-current="page" href="index.php?p=mystory">My Story</a>
                        </li>
                        <li class="nav-item text-uppercase">
                            <a class="nav-link font-nerko-one <?php if(isset($_GET['p'])=='notif'){ echo 'active'; } ?>" aria-current="page" href="index.php?p=notif">Notifications</a>
                        </li>
                        <li class="nav-item text-uppercase">
                            <a class="nav-link font-nerko-one" aria-current="page" href="index.php?logout">Logout</a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        if (isset($_GET['p'])=='') {
            include 'home/index.php';
        } elseif ($_GET['p']=='login') {
            include 'auth/login.php';
        } elseif ($_GET['p']=='register') {
            include 'auth/register.php';
        } elseif ($_GET['p']=='forgotpassword') {
            include 'auth/forgotpassword.php';
        } elseif ($_GET['p']=='changepassword') {
            include 'auth/changepassword.php';
        } elseif ($_GET['p']=='story') {
            include 'story/index.php';
        } elseif ($_GET['p']=='storyadd') {
            include 'story/add.php';
        } elseif ($_GET['p']=='mystory') {
            include 'story/mystory.php';
        } elseif ($_GET['p']=='notif') {
            include 'notif/index.php';
        } else {
            echo "<script>
                alert('Halaman tidak ada.');
                window.location.href='../index.php';
            </script>";
        }

        if ($uri_segments[3] == 'index.php' && isset($uri_segments[4]) <> '') {
            echo "<script>
                alert('Halaman tidak ada.');
                window.location.href='../index.php';
            </script>";
        }
    ?>

    
    <script>
        // @if(Session::has('success'))
        // toastr.options =
        // {
        //     "closeButton" : true,
        //     "progressBar" : true,
        // }
        //         toastr.success("{{ session('success') }}");
        // @endif
        
        // @if(Session::has('errors'))
        // toastr.options =
        //     {
        //         "closeButton" : true,
        //         "progressBar" : true
        //     }
        //     @foreach ($errors->all() as $errors)
        //         toastr.error("{{ $errors }}");
        //     @endforeach
        // @endif
        
        // @if(Session::has('warning'))
        //     toastr.options =
        //         {
        //             "closeButton" : true,
        //             "progressBar" : true
        //         }
        //     toastr.warning("{{ session('warning') }}");
        // @endif
    </script>
    
  </body>
</html>