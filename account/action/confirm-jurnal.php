<?php
    require_once "../akses.php";
    $jurnalno    = strtoupper($_POST["jurnalno"]);
    $SQL = "UPDATE mutasi SET report='1' WHERE jurnalno='$jurnalno'";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysql_error());

    header ("Location:../keuangan?message=Jurnal harian berhasil disimpan&alert=alert alert-success");
?>