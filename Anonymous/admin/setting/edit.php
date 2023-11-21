<?php
    $id = $_GET['id'];
    $sql_setting = "SELECT * FROM settings WHERE id='$id'";
    $result_setting = mysqli_query($koneksi, $sql_setting);
    $setting = mysqli_fetch_assoc($result_setting);

    $nama_websiteErr = '';
    $taglineErr = '';
    if (isset($_POST['submit'])) {        
        if (empty($_POST["nama_website"])) {
            $nama_websiteErr = "Nama Website is required";
        }

        if (empty($_POST["tagline"])) {
            $taglineErr = "Tagline is required";
        }

        if (!empty($_POST["nama_website"]) && !empty($_POST["tagline"])) {
            $nama_website = $_POST['nama_website'];
            $tagline = $_POST['tagline'];
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');

            if ($_FILES['gambar_background']['name'] <> '') {
                $filename = $_FILES['gambar_background']['name'];
                $tempname = $_FILES['gambar_background']['tmp_name'];
                $gambar_background = 'images/'.$filename;
                move_uploaded_file($tempname, '../../'.$gambar_background);
            } else {
                $gambar_background = $setting['gambar_background'];
            }

            if ($_FILES['favicon']['name'] <> '') {
                $filename = $_FILES['favicon']['name'];
                $tempname = $_FILES['favicon']['tmp_name'];
                $favicon = 'images/'.$filename;
                move_uploaded_file($tempname, '../../'.$favicon);
            } else {
                $favicon = $setting['favicon'];
            }
            
            $query = "UPDATE settings SET nama_website = '$nama_website', tagline = '$tagline', gambar_background = '$gambar_background', favicon = '$favicon' WHERE id = '$id'";

            $result = mysqli_query($koneksi, $query);
            if ($result) {
                echo "<script>
                    alert('Berhasil mengupdate setting.');
                    window.location.href='index.php?a=setting';
                </script>";
            }
        }
    }
?>

<div class="section-header">
    <div class="section-header-back">
        <a href="index.php?a=setting" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Setting Website</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="index.php?a=setting">Setting Website</a></div>
        <div class="breadcrumb-item active">Edit</div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Setting Website</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Website</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama_website" class="form-control" value="<?= $setting['nama_website'] ?>">
                            <i class="text-danger"><?= $nama_websiteErr ?></i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tagline</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="tagline" class="form-control" value="<?= $setting['tagline'] ?>">
                            <i class="text-danger"><?= $taglineErr ?></i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Background Sebelumnya</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                <img src="../<?= $setting['gambar_background'] ?>" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar Background</label>
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview3" class="image-preview">
                                <label for="image-upload3" id="image-label3">Choose File</label>
                                <input type="file" name="gambar_background" id="image-upload3" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Favicon Sebelumnya</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                <img src="../<?= $setting['favicon'] ?>" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Favicon</label>
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview2" class="image-preview">
                                <label for="image-upload2" id="image-label2">Choose File</label>
                                <input type="file" name="favicon" id="image-upload2" />
                            </div>
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