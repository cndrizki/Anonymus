<div class="section-header">
    <h1>Setting Website</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="index.php?a=setting">Setting Website</a></div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h4>Setting Website</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Nama Website</th>
                                <th>Tagline</th>
                                <th>Gambar Background</th>
                                <th>Favicon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_setting = "SELECT * FROM settings ORDER BY id DESC";
                                $result_setting = mysqli_query($koneksi, $sql_setting);
                                $no = 1;
                                while ($setting = mysqli_fetch_assoc($result_setting)) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $setting['nama_website'] ?></td>
                                    <td><?= $setting['tagline'] ?></td>
                                    <td>
                                        <img src="../<?= $setting['gambar_background'] ?>" width="50">
                                    </td>
                                    <td>
                                        <img src="../<?= $setting['favicon'] ?>" width="50">
                                    </td>
                                    <td>
                                        <a href="index.php?a=settingedit&id=<?= $setting['id'] ?>" class="btn btn-primary btn-sm mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
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