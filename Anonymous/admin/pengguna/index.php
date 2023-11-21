<?php
    if (isset($_POST['submit'])) {
        $user_id = $_POST['user_id'];
        $sql_pengguna_delete = "DELETE FROM users WHERE id='$user_id'";
        $result_pengguna_delete = mysqli_query($koneksi, $sql_pengguna_delete);
        if ($result_pengguna_delete) {
            echo "<script>
                alert('Berhasil menghapus pengguna.');
                window.location.href='index.php?a=pengguna';
            </script>";
        }
    }
?>

<div class="section-header">
    <h1>Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="index.php?a=pengguna">Pengguna</a></div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h4>Pengguna</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_pengguna = "SELECT * FROM users WHERE role = 'pengguna' ORDER BY id DESC";
                                $result_pengguna = mysqli_query($koneksi, $sql_pengguna);
                                $no = 1;
                                while ($pengguna = mysqli_fetch_assoc($result_pengguna)) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $pengguna['email'] ?></td>
                                    <td><?= $pengguna['no_hp'] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="user_id" value="<?= $pengguna['id'] ?>">
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
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