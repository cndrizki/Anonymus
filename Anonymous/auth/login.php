<section class="login-form">
    <div class="container">
        <h1 class="font-nerko-one text-uppercase"><?= $setting['nama_website'] ?></h1>

        <?php
        session_start();
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts']= 0;
        }

        function loginAttemp(){
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts']>5){

            }
        }

        $emailErr = '';
        $passwordErr = '';
        if (isset($_POST['submit'])) {
            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $passwordErr = '';
            }
            if (!empty($_POST["email"]) && !empty($_POST["password"])) {
                $email = htmlspecialchars(strip_tags($_POST['email']));
                $password = $_POST['password'];}

            loginAttemp();

            $sql_count_user = "SELECT count(*) as total_count, password, email, id, name, role FROM users WHERE email = ?";
            $stmt = mysqli_prepare($koneksi, $sql_count_user);
    
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
    
                if (mysqli_stmt_execute($stmt)) {
                    $result_count_user = mysqli_stmt_get_result($stmt);
                    $user_count = mysqli_fetch_assoc($result_count_user);

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            } else {
                $emailErr = '';

                mysqli_stmt_close($stmt);
            }
        }
    }

            if (!empty($_POST["email"]) && !empty($_POST["password"])) {
                $email = htmlspecialchars(strip_tags($_POST['email']));
                $password = $_POST['password'];

                $sql_count_user = "SELECT count(*) as total_count, password, email, id, name, role FROM users WHERE email = ?";
                $stmt = mysqli_prepare($koneksi, $sql_count_user);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $email);

                    if (mysqli_stmt_execute($stmt)) {
                        $result_count_user = mysqli_stmt_get_result($stmt);
                        $user_count = mysqli_fetch_assoc($result_count_user);

                        if ($user_count['total_count'] > 0) {
                            if (password_verify($password, $user_count['password'])) {
                                if ($user_count['role'] == 'pengguna') {
                                    $_SESSION['login_user'] = true;
                                    $_SESSION['user_id'] = $user_count['id'];
                                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

                                    echo "<script>
                                    alert('Anda telah login.');
                                    window.location.href='index.php';
                                </script>";
                                } else {
                                    $_SESSION['login_admin'] = true;
                                    $_SESSION['admin_name'] = $user_count['name'];
                                    $_SESSION['admin_id'] = $user_count['id'];

                                    echo "<script>
                                    alert('Anda telah login.');
                                    window.location.href='admin/index.php';
                                </script>";
                                }
                            } else {
                                echo "<script>
                                alert('Password tidak sesuai.');
                                window.location.href='index.php?p=login';
                            </script>";
                            }
                        } else {
                            echo "<script>
                            alert('Akun tidak ditemukan.');
                            window.location.href='index.php?p=login';
                        </script>";
                        }
                    } else {
                        echo "Error executing statement: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                }
            }
        }
        ?>

        <form action="" method="post">
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
                <i class="text-danger font-nerko-one"><?= $emailErr ?></i>
            </div>                
            <div class="form-group text-left mb-4">
                <label for="" class="font-nerko-one">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <i class="text-danger font-nerko-one"><?= $passwordErr ?></i><br>
                <a href="index.php?p=forgotpassword" class="font-nerko-one forgot-password text-uppercase">Forgot Password?</a>
            </div>
            <div class="form-group mb-2">
                <button type="submit" name="submit" class="btn btn-custom font-nerko-one">Login</button>
            </div>
            <div class="form-group mb-4">
                <p class="font-nerko-one">Don't have an account? <a href="index.php?p=register" class="forgot-password text-uppercase">Register</a></p>
            </div>
        </form>
    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
