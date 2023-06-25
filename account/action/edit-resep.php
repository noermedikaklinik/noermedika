<?php
    require_once("../akses.php");
    $id_resep = $_GET['id_resep'];
    $status = $_GET['status'];

    mysqli_query($koneksi, "UPDATE db_resep set status=$status WHERE no=$id_resep") or die(mysqli_error($koneksi));
    header("Location:../kasir.php");
?>