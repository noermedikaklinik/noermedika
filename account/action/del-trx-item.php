<?php
    require "../akses.php";
    $no       = $_GET['no'];
    $kode_trx = $_GET['kode_trx'];
    
    $SQL = "DELETE from db_penjualan where no='$no' and kode_trx='$kode_trx' and id_user='$akses[id_user]'";
    mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    header("location:../frame-transaksi-penjualan?kode_trx=$kode_trx&message=Item berhasil dibatalkan&alert=alert alert-success");
?>