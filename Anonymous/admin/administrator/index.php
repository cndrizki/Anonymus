<?php
    if (isset($_POST['submit'])) {
        $user_id = $_POST['user_id'];
        $sql_administrator_delete = "DELETE FROM users WHERE id='$user_id'";
        $result_administrator_delete = mysqli_query($koneksi, $sql_administrator_delete);
        if ($result_administrator_delete) {
            echo "<script>
                alert('Berhasil menghapus administrator.');
                window.location.href='index.php?a=administrator';
            </script>";
        }
    }
?>

<div class="section-header">
    <h1>Administrator</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="index.php?a=administrator">Administrator</a></div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h4>Administrator</h4>
                <a href="index.php?a=administratoradd" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Nama Administrator</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_admin = "SELECT * FROM users WHERE role = 'admin' ORDER BY id DESC";
                                $result_admin = mysqli_query($koneksi, $sql_admin);
                                $no = 1;
                                while ($admin = mysqli_fetch_assoc($result_admin)) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $admin['name'] ?></td>
                                    <td><?= $admin['email'] ?></td>
                                    <td>
                                        <a href="index.php?a=administratoredit&id=<?= $admin['id'] ?>" class="btn btn-primary btn-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php
                                            if ($admin['id'] <> $_SESSION['admin_id']) {
                                        ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="user_id" value="<?= $admin['id'] ?>">
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>