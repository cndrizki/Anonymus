<?php
$emailErr = '';
$nohpErr = '';
$passwordErr = '';
$passwordConfirmErr = '';
if (isset($_POST['submit'])) {
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $emailErr = "Invalid email format";
    }

    if (empty($_POST["password_confirmation"])) {
        $passwordConfirmErr = "Password Confirm is required";
    } elseif ($_POST["password_confirmation"] <> $_POST["password"]) {
        $passwordConfirmErr = 'Password confirm not match';
    }

    if (empty($_POST["no_hp"])) {
        $nohpErr = "No HP is required";
    } elseif (!filter_var($_POST["no_hp"], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nohpErr = "Invalid no hp format";
    }

    if (!empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password_confirmation"]) && !empty($_POST["no_hp"])) {
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $no_hp = htmlspecialchars(strip_tags($_POST['no_hp']));
        ;
        $role = 'pengguna';
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        try {
            $query = "INSERT INTO users (email, no_hp, role, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $email, $no_hp, $role, $password, $created_at, $updated_at);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>
                            alert('Pendaftaran berhasil.');
                            window.location.href='index.php?p=login';
                        </script>";
                } else {
                    throw new mysqli_sql_exception(mysqli_stmt_error($stmt));
                }

                mysqli_stmt_close($stmt);
            }
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                if (strpos($e->getMessage(), 'users_email_unique') !== false) {
                    echo "<script>
                            alert('Email sudah terdaftar. Silakan gunakan email lain.');
                        </script>";
                } elseif (strpos($e->getMessage(), 'users_no_hp_unique') !== false) {
                    echo "<script>
                            alert('Nomor HP sudah terdaftar. Silakan gunakan nomor HP lain.');
                        </script>";
                } else {
                    echo "<script>
                            alert('Terjadi kesalahan saat mendaftar.');
                        </script>";
                }
            } else {
                echo "<script>
                        alert('Terjadi kesalahan saat mendaftar.');
                    </script>";
            }
        }

    }
}
?>

<section class="login-form">
    <div class="container">
        <h1 class="font-nerko-one text-uppercase">
            <?= $setting['nama_website'] ?>
        </h1>

        <form action="" method="post">
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
                <i class="text-danger font-nerko-one">
                    <?= $emailErr ?>
                </i>
            </div>
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">No Handphone</label>
                <input type="number" name="no_hp" class="form-control" placeholder="No Handphone">
                <i class="text-danger font-nerko-one">
                    <?= $nohpErr ?>
                </i>
            </div>
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <i class="text-danger font-nerko-one">
                    <?= $passwordErr ?>
                </i>
            </div>
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Password Confirmation">
                <i class="text-danger font-nerko-one">
                    <?= $passwordConfirmErr ?>
                </i>
            </div>
            <div class="form-group mb-2">
                <button type="submit" name="submit" class="btn btn-custom font-nerko-one">Register</button>
            </div>
            <div class="form-group mb-4">
                <p class="font-nerko-one">I have an account? <a href="index.php?p=login"
                        class="forgot-password text-uppercase">Login</a></p>
            </div>
        </form>
    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>