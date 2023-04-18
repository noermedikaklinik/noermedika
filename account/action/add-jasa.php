<?php
    require("../../configuration/koneksi.php");
    $nama_jasa = ucwords($_POST['nama_jasa']);
    $harga     = preg_replace("/[^0-9]/", "", $_POST['harga']);
    $SQL = "INSERT INTO db_jasa (nama_jasa,harga)
    VALUES ('$nama_jasa','$harga')";
    mysqli_query($koneksi, $SQL) or die (mysql_error());
    
    header ("Location:../list-jasa?message=Data produk jasa berhasil ditambah&alert=alert alert-success");
?>