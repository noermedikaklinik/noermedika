<?php
    require "../akses.php";
    $kategori_cust     = strtoupper($_POST['kategori_cust']);
    $id_konsulen       = strtoupper($_POST['id_konsulen']);
    $no                = strtoupper($_POST['no']);
    $kode_trx          = strtoupper($_POST['kode_trx']);
    
    $result1   = mysqli_query($koneksi, "SELECT * FROM db_jasa where no like '$no'");
    $jasa      = mysqli_fetch_assoc($result1);
    
    $sub_total_beli = 1 * $jasa["harga"];
    $sub_total_jual = 1 * $jasa["harga"];
    $ppn            = $sub_total_jual * 10/100;
    $sub_total_ppn  = $ppn + $sub_total_jual;
    
    $tglnow = date("Y-m-d");
    $jam    = date("H:i:s");
    
    $SQL = "INSERT INTO db_penjualan (tanggal,jam,nota,kode_trx,urut,id_produk,item,harga_beli,harga_jual,qty,sub_total_beli,sub_total_jual,ppn,sub_total_ppn,kategori_plg,id_user,id_konsulen)
    VALUES ('$tglnow','$jam','$nota','$kode_trx','$urut','$no','$jasa[nama_jasa]','$sub_total_beli','$jasa[harga]','1','$sub_total_beli','$sub_total_jual','$ppn','$sub_total_ppn','$kategori_cust','$akses[id_user]','$id_konsulen')";
    mysqli_query($koneksi, $SQL) or die (mysql_error());
    
    header ("Location:../penjualan-produk?kode_trx=$kode_trx&kategori_cust=$kategori_cust&id_konsulen=$id_konsulen");
?>