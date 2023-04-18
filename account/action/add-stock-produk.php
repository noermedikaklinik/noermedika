<?php
    require("../akses.php");
    $id_produk         = strtoupper($_POST['id_produk']);
    $nota_beli         = strtoupper($_POST['nota_beli']);
    $tanggal           = $_POST['tanggal'];
    $expired           = $_POST['expired'];
    $jumlah            = preg_replace("/[^0-9]/", "", $_POST['jumlah']);

    $result1   = mysqli_query($koneksi, "SELECT * FROM db_produk where id_produk like '$id_produk'");
    $produk    = mysqli_fetch_assoc($result1);

    $total_persediaan = $jumlah * $produk['harga_beli'];

    $SQL = "INSERT INTO db_stock_produk (tanggal,nota,id_produk,harga_beli,jumlah,total_persediaan,expired,id_user,id_supplier)
    VALUES ('$tanggal','$nota_beli','$id_produk','$produk[harga_beli]','$jumlah','$total_persediaan','$expired','$akses[id_user]','$produk[id_supplier]')";
    mysqli_query($koneksi, $SQL) or die (mysql_error());

    header ("Location:../add-stock-produk?id_produk=$id_produk&message=Persediaan barang berhasil ditambahkan&alert=alert alert-success&nota_beli=$nota_beli");
?>