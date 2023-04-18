<?php
    include "../akses.php";
    $no        = $_GET['no'];
    $sql  = "DELETE FROM db_stock_produk WHERE no LIKE '$no'";	
    $qry  = mysqli_query($koneksi, $sql) or die ("Query Gagal ".mysql_error());

    header ("Location:../mutasi-stock-product?message=Stok Produk Masuk Berhasil Dibatalkan&alert=alert alert-success");
?>