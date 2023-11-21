<?php
    $server = 'localhost';
    $user   = 'root';
    $pass   = '';
    $db     = 'anonymous';
    $koneksi = mysqli_connect($server, $user, $pass, $db);

    if ($koneksi) {
        // echo 'berhasil';
    } else {
        echo 'gagal';
    }
?>