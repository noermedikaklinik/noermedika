<?php
    require "../akses.php";
    $id_user      = $_POST['id_user'];
    $tanggal      = $_POST['tanggal'];
    $status_setor = $_POST['status_setor'];
    
    $sql = "SELECT * FROM db_penjualan where tanggal like '$tanggal' and status like '1' and id_user like '$id_user' and status_setor like '0' group by nota";
    $qry = mysqli_query($koneksi, $sql) or die ("Query Gagal ".mysqli_error());
    while($res=mysqli_fetch_array($qry)){
        
    if ($res["jenis_pembayaran"] == "CASH") {$akun_kas = "KAS";}
    if ($res["jenis_pembayaran"] == "DEBIT"){$akun_kas = "BCA";}
    
    ///////////// hpp dan persediaan //////////////////
    $sqlpengunjung="select sum(sub_total_beli) kunjung from db_penjualan where nota like '$res[nota]'";
    $resultpengunjung = mysqli_query($sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjung1=$pengunjung->kunjung;
    $a1 = $totalpengunjung1;
    
    $kode1 = rand(6,999999); $jurnalno1 = "GL-$kode1";
    
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno1','$res[nota]','$tanggal','','$a1','','HPP','HPP','DEBET','1','AKTIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno1','$res[nota]','$tanggal','','','$a1','PERSEDIAAN','PERSEDIAAN BARANG','KREDIT','1','AKTIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    
    ///////////// pendapatan penjualan dan kas //////////////////
    $sqlpengunjung="select sum(sub_total_jual) kunjung from db_penjualan where nota like '$res[nota]'";
    $resultpengunjung = mysqli_query($sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjung2=$pengunjung->kunjung;
    $a2 = $totalpengunjung2;
    
    $kode2 = rand(6,999999); $jurnalno2 = "GL-$kode2";
    
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno2','$res[nota]','$tanggal','','','$a2','PENDAPATAN','PENDAPATAN PENJUALAN','KREDIT','1','AKTIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno2','$res[nota]','$tanggal','','$a2','','KAS','$akun_kas','DEBET','1','AKTIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    
    ///////////// hutang fee dan biaya biaya //////////////////
    if ($res['kategori_plg'] == "RESEP")
    {
    $kode3 = rand(6,999999); $jurnalno3 = "GL-$kode3";
    
    $sqlpengunjung="select sum(sub_total_jual) kunjung from db_penjualan where nota like '$res[nota]'";
    $resultpengunjung = mysqli_query($sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjung3=$pengunjung->kunjung;
    $a3 = $totalpengunjung3;
    
    $result1 = mysqli_query($koneksi, "SELECT * FROM db_konsulen where id_user like '$res[id_konsulen]'");
    $kons    = mysqli_fetch_assoc($result1);
    
    $fee_konsulen  = $a3 * $kons['fee']/100;
    
    $result2 = mysqli_query($koneksi, "SELECT * FROM db_user where id_user like '$res[id_apoteker]'");
    $apt     = mysqli_fetch_assoc($result2);
    
    $fee_apoteker = $a3 * $apt['fee']/100;
    
    //////////// fee konsulen //////////////
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno3','$res[nota]','$tanggal','','','$fee_konsulen','HUTANG','HUTANG FEE KONSULEN','KREDIT','1','PASIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno3','$res[nota]','$tanggal','','$fee_konsulen','','BIAYA BIAYA','FEE KONSULEN','DEBET','1','AKTIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    
    /////////// fee apoteker /////////////
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno3','$res[nota]','$tanggal','','','$fee_apoteker','HUTANG','HUTANG FEE APOTEKER','KREDIT','1','PASIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    
    $SQL = "INSERT INTO mutasi (jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('$jurnalno3','$res[nota]','$tanggal','','$fee_apoteker','','BIAYA BIAYA','FEE APOTEKER','DEBET','1','AKTIVA')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysqli_error());
    }
    }
    
    $SQL = "UPDATE db_penjualan SET status_setor='$status_setor', terima_oleh='$row[id_user]', tgl_setor='$tglnow' where id_user='$id_user' and tanggal='$tanggal'";
    mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    header ("Location:../lap-kasir?message=Setoran kasir telah diterima&alert=alert alert-success");

?>