<?php
    require "../akses.php";
    $id_jasa = $_GET['no'];
    $is_exist_query = mysqli_query($koneksi, "SELECT * FROM db_penjualan WHERE status='0' and id_jasa= '$id_jasa'");
    $jasa_query = mysqli_query($koneksi, "SELECT * FROM db_jasa WHERE no=$id_jasa") or die(mysqli_error($koneksi));
    $jasa = mysqli_fetch_array($jasa_query);
    if(mysqli_num_rows($is_exist_query) == 0){
        $SQL = "INSERT INTO db_penjualan 
        (jenis_penjualan,item, id_jasa, harga, qty, sub_total, id_user, status)
        VALUE
        ('jasa', '$jasa[nama_jasa]', '$id_jasa',$jasa[harga], 1, $jasa[harga], '$id_user', '0')
        ";
        mysqli_query($koneksi, $SQL);
        header("Location:../kasir.php");
    }else{
        $data = mysqli_fetch_array($is_exist_query);
        $qty = $data["qty"]+1;
        $subTotal = $qty*$jasa['harga'];
        $update_query = mysqli_query($koneksi, "UPDATE db_penjualan SET qty=$qty, sub_total=$subTotal WHERE id_jasa='$id_jasa' and status='0'") or die(mysqli_error($koneksi));
        header("Location:../kasir.php");
    }
?>
