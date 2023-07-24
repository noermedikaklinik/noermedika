<?php
    require("../akses.php");
    $id_produk         = strtoupper($_GET['id_produk']);
    $selectProduct = mysqli_query($koneksi,"SELECT * FROM db_produk WHERE no=$id_produk");
    $dataProduct = mysqli_fetch_array($selectProduct);
    
    $is_exist_query = mysqli_query($koneksi, "SELECT * FROM db_penjualan WHERE status='0' and id_produk= '$id_produk'");
    if(mysqli_num_rows($is_exist_query) == 0){
        $namaProduk = $dataProduct['nama_produk'];
        $hargaJual = $dataProduct['harga_jual'];
        $SQL = "INSERT INTO db_penjualan 
        (jenis_penjualan, id_produk, item, harga, qty, sub_total, id_user, status)
        VALUE
        ('produk', $id_produk, '$namaProduk', $hargaJual, 1, $hargaJual, $id_user, 0)";
        mysqli_query($koneksi, $SQL);
        header("Location:../kasir.php");
    }else{
        $data = mysqli_fetch_array($is_exist_query);
        $qty = $data["qty"]+1;
        $subTotal = $qty*$dataProduct['harga_jual'];
        $update_query = mysqli_query($koneksi, "UPDATE db_penjualan SET qty=$qty, sub_total=$subTotal WHERE id_produk='$id_produk' and status='0'") or die(mysqli_error($koneksi));
        header("Location:../kasir.php");
    }
?>