<?php

    $storyErr = '';

    if ($_SESSION['user_id'] <> true) {
        echo "<script>
            alert('Anda harus login terlebih dahulu.');
            window.location.href='./index.php?p=login';
        </script>";
    }

    function generateToken(){
        $token = md5(uniqid(rand(), true)); 
        return $token;
      }

    if(!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = generateToken();
    }
    $csrf_token = $_SESSION['csrf_token'];

    if (isset($_POST['submit'])) {
        if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $csrf_token){
            die("CSRF token invalid!"); 
          }
        if (empty($_POST["story"])) {
            $storyErr = "Story is required";
        } elseif (!filter_var($_POST["story"], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $storyErr = "Invalid Story format"; 
        }

        if (!empty($_POST["story"])) {
            $story = htmlspecialchars(strip_tags($_POST['story']));
            $user_id = $_SESSION['user_id'];
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            
            $query = "INSERT INTO stories (user_id, story, created_at, updated_at) VALUES ('$user_id', '$story', '$created_at', '$updated_at')";
            $result = mysqli_query($koneksi, $query);
            if ($result) {
                echo "<script>
                    alert('Berhasil menambahkan story baru.');
                    window.location.href='index.php?p=mystory';
                </script>";
            }
            $_SESSION['csrf_token'] = generateToken();
        }
    }
?>

<section class="post">
    <div class="container-fluid">
        <div class="post-header">
            <div class="image">
                <img src="images/user.png" class="img-fluid">
            </div>
            <h1 class="font-new-rocker text-uppercase text-white">Anonymous</h1>
        </div>
        <div class="post-content">
        <div class="row">
                <div class="col-md-4 col-sm-12 mb-2">
                    <a href="index.php?p=storyadd" class="btn btn-custome-white d-block">Add</a>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <a href="index.php?p=mystory" class="btn btn-custome-white d-block">My Story</a>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <a href="index.php?p=story" class="btn btn-custome-white d-block">All Story</a>
                </div>
            </div>
            <div class="container mt-4">
                <form action="" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <div class="col-md-1 col-sm-12 text-center">
                                    <img src="images/user.png" class="img-fluid">
                                </div>
                                <div class="col-md-11">
                                    <textarea name="story" class="form-control" rows="3" placeholder="Create your story"></textarea>
                                    <i class="text-danger font-nerko-one"><?= $storyErr ?></i>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-custom font-nerko-one">Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
