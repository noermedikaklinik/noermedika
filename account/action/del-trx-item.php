<?php
    require "../akses.php";
    $no       = $_GET['no'];
    $kode_trx = $_GET['kode_trx'];
    
    $SQL = "DELETE from db_penjualan where no='$no'";
    mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    header("location:../kasir?message=Item berhasil dibatalkan&alert=alert alert-success");
?>