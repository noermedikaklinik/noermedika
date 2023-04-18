<?php
    require("../../configuration/koneksi.php");
    $no        = $_GET['no'];
    $SQL = "UPDATE db_jasa SET view='0' where no='$no'";
    mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    header("location:../list-jasa?message=Data produk jasa berhasil dihapus&alert=alert alert-success");
?>