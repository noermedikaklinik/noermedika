<?php
    require "../akses.php";
    $kategori_cust     = strtoupper($_POST['kategori_cust']);
    $id_konsulen       = strtoupper($_POST['id_konsulen']);
    $id_produk         = strtoupper($_POST['id_produk']);
    $kode_trx          = strtoupper($_POST['kode_trx']);
    $sisa_stock        = $_POST['sisa_stock'];
    $jumlah            = preg_replace("/[^0-9]/", "", $_POST['jumlah']);
    
    if ($jumlah > $sisa_stock){header ("Location:../penjualan-produk?kode_trx=$kode_trx&kategori_cust=$kategori_cust&id_konsulen=$id_konsulen&message=Stock Tidak Mencukupi&alert=alert alert-danger"); exit;}
    
    $result1   = mysqli_query($koneksi, "SELECT * FROM db_produk where id_produk like '$id_produk'");
    $produk    = mysqli_fetch_assoc($result1);
    
    $sub_total_beli = $jumlah * $produk["harga_beli"];
    $sub_total_jual = $jumlah * $produk["harga_jual"];
    $ppn            = $sub_total_jual * 10/100;
    $sub_total_ppn  = $ppn + $sub_total_jual;
    
    $tglnow = date("Y-m-d");
    $jam    = date("H:i:s");
    
    $SQL = "INSERT INTO db_penjualan (tanggal,jam,nota,kode_trx,urut,id_produk,item,harga_beli,harga_jual,qty,sub_total_beli,sub_total_jual,ppn,sub_total_ppn,kategori_plg,id_user,id_konsulen)
    VALUES ('$tglnow','$jam','$nota','$kode_trx','$urut','$id_produk','$produk[nama_produk]','$produk[harga_beli]','$produk[harga_jual]','$jumlah','$sub_total_beli','$sub_total_jual','$ppn','$sub_total_ppn','$kategori_cust','$akses[id_user]','$id_konsulen')";
    mysqli_query($koneksi, $SQL) or die (mysql_error());
    
    header ("Location:../penjualan-produk?kode_trx=$kode_trx&kategori_cust=$kategori_cust&id_konsulen=$id_konsulen");
?>