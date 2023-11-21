<?php
    $email = $_GET['email'];

    $passwordErr = '';
    $passwordConfirmErr = '';
    if (isset($_POST['submit'])) {
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        }

        if (empty($_POST["password_confirmation"])) {
            $passwordConfirmErr = "Password Confirm is required";
        } elseif ($_POST["password_confirmation"] <> $_POST["password"]) {
            $passwordConfirmErr = 'Password confirm not match';
        }

        if (!empty($_POST["password"]) && !empty($_POST["password_confirmation"])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $updated_at = date('Y-m-d H:i:s');
            
            $query = "UPDATE users SET password = '$password', updated_at = '$updated_at' WHERE email = '$email'";
            $result = mysqli_query($koneksi, $query);
            if ($result) {
                echo "<script>
                    alert('Password berhasil diganti.');
                    window.location.href='index.php?p=login';
                </script>";
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
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $email ?>" readonly>
            </div>
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <i class="text-danger font-nerko-one"><?= $passwordErr ?></i>
            </div>
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
                <i class="text-danger font-nerko-one"><?= $passwordConfirmErr ?></i>
            </div>
            <div class="form-group mb-2">
                <button type="submit" name="submit" class="btn btn-custom font-nerko-one">Change Password</button>
            </div>
        </form>
    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>