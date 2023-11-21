<?php
    $sql_pengguna = "SELECT COUNT(*) as total_pengguna FROM users WHERE role = 'pengguna'";
    $result_pengguna = mysqli_query($koneksi, $sql_pengguna);
    $pengguna = mysqli_fetch_assoc($result_pengguna);
    $jumlahpengguna = $pengguna['total_pengguna'];

    $sql_story = "SELECT COUNT(*) as total_story FROM stories";
    $result_story = mysqli_query($koneksi, $sql_story);
    $story = mysqli_fetch_assoc($result_story);
    $totalstory = $story['total_story'];
?>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Pengguna</h4>
                </div>
                <div class="card-body">
                    <?= $jumlahpengguna ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-warning bg-warning">
                <i class="fas fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Story</h4>
                </div>
                <div class="card-body">
                    <?= $totalstory ?>
                </div>
            </div>
        </div>
    </div>
</div>