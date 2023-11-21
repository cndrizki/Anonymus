<?php
    $emailErr = '';
    $nama_administratorErr = '';
    $passwordErr = '';
    if (isset($_POST['submit'])) {
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        }
        
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
        }

        if (empty($_POST["nama_administrator"])) {
            $nama_administratorErr = "Nama administrator is required";
        }

        if (!empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["nama_administrator"])) {
            $email = $_POST['email'];
            $nama_administrator = $_POST['nama_administrator'];
            $role = 'admin';
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            
            $query = "INSERT INTO users (email, name, role, password, created_at, updated_at) VALUES ('$email', '$nama_administrator', '$role', '$password', '$created_at', '$updated_at')";
            $result = mysqli_query($koneksi, $query);
            if ($result) {
                echo "<script>
                    alert('Berhasil menambahkan administrator baru.');
                    window.location.href='index.php?a=administrator';
                </script>";
            }
        }
    }
?>

<div class="section-header">
    <div class="section-header-back">
        <a href="index.php?a=administrator" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Administrator</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="index.php?a=administrator">Administrator</a></div>
        <div class="breadcrumb-item active">Tambah</div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Administrator</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Administrator</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_administrator" class="form-control">
                            <i class="text-danger"><?= $nama_administratorErr ?></i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="email" name="email" class="form-control">
                            <i class="text-danger"><?= $emailErr ?></i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" name="password" class="form-control">
                            <i class="text-danger"><?= $passwordErr ?></i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>