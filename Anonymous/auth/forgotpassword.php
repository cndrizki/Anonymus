<?php
    $emailErr = '';
    if (isset($_POST['submit'])) {
        if (empty($_POST["email"])) {
            $emailErr = "email is required";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $emailErr = "Invalid email format"; 
        }

        if (!empty($_POST["email"])) {
            $email = htmlspecialchars(strip_tags($_POST['email']));
            
            $query = "SELECT count(*) as total_user FROM users WHERE email ='$email' AND role = 'pengguna'";
            $result = mysqli_query($koneksi, $query);
            if ($result) {
                $user = mysqli_fetch_assoc($result);

                if ($user['total_user'] > 0) {
                    echo "<script>
                        alert('Email ditemukan.');
                        window.location.href='index.php?p=changepassword&email=$email';
                    </script>";
                } else {
                    echo "<script>
                        alert('Email tidak ditemukan.');
                        window.location.href='index.php?p=forgotpassword';
                    </script>";
                }
            }
        }
    }
?>

<section class="login-form">
    <div class="container">
        <h1 class="font-nerko-one text-uppercase"><?= $setting['nama_website'] ?></h1>
        
        <form action="" method="post">
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
                <i class="text-danger font-nerko-one"><?= $emailErr ?></i>
            </div>
            <div class="form-group mb-2">
                <button type="submit" name="submit" class="btn btn-custom font-nerko-one">Check</button>
            </div>
        </form>

    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>