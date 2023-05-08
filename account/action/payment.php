<?php
    require "../akses.php";
    $kategori_cust = strtoupper($_POST['kategori_cust']);
    $id_apoteker   = strtoupper($_POST['id_apoteker']);
    $tipe          = strtoupper($_POST['tipe']);
    $nama          = strtoupper($_POST['nama']);
    $hp            = strtoupper($_POST['hp']);
    $kode_trx      = strtoupper($_POST['kode_trx']);
    $no_kartu      = strtoupper(isset($_POST['no_karty'])?$_POST['no_kartu']:"");
    $nama_pemegang = strtoupper(isset($_POST['nama_pemegang'])?$_POST['nama_pemegang']:"");
    $bank          = strtoupper(isset($_POST['bank'])?$_POST['bank']:"");
    $expired_date  = strtoupper(isset($_POST['expired_date'])?$_POST['expired_date']:"");
    $cash_terima   = preg_replace("/[^0-9]/", "", $_POST['cash_terima']);
    $grand_total   = $_POST['grand_total'];
    $id_user       = $akses['no'];
    
    if ($tipe == "")     {header ("Location:../penjualan-produk?kode_trx=$kode_trx&kategori_cust=$kategori_cust&message=Anda belum memilih jenis pembayaran&alert=alert alert-danger");exit;}
    if ($tipe == "DEBIT" and $grand_total <= "99999")     {header ("Location:../penjualan-produk?kode_trx=$kode_trx&kategori_cust=$kategori_cust&message=Pembayaran Dengan DEBIT atau KARTU KREDIT Minimum transaksi Rp. 100.000&alert=alert alert-danger");exit;}
    if ($tipe == "DEBIT" and $grand_total >= "100000")    {$cash_terima2 = $grand_total;$cash_return   = 0;}
    if ($tipe == "CASH" and $grand_total > $cash_terima)  {header ("Location:../penjualan-produk?kode_trx=$kode_trx&kategori_cust=$kategori_cust&message=Nominal Pembayaran Tidak Sesuai&alert=alert alert-danger"); exit;}
    if ($tipe == "CASH" and $grand_total < $cash_terima)  {$cash_terima2 = $cash_terima;$cash_return   = $cash_terima - $grand_total;}
    if ($tipe == "CASH" and $grand_total == $cash_terima) {$cash_terima2 = $cash_terima;$cash_return   = $cash_terima - $grand_total;}
    if ($tipe == "QRISBCA")                               {$cash_terima2 = $grand_total;$cash_return   = 0;}
    
    if ($nama == "" and $hp == ""){$nama2 = "UMUM";$hp2 = "62";}
    if ($nama <> "" and $hp <> ""){$nama2 = $nama;$hp2 = $hp;}
    
    
    $result1   = mysqli_query($koneksi, "SELECT urut FROM db_penjualan order by urut desc");
    $trx       = mysqli_fetch_assoc($result1);
    $tglnow1   = date("Y-m-d");
    $hari      = date("d"); $bln = date("m"); $thn = date("Y");
    $urut      = $trx['urut'] + 1;
    $nota      = "$hari$bln$thn$urut";
    $ppn = $grand_total * 11 / 100;
    $sql_insert_pembayaran = "INSERT INTO db_pembayaran 
    (nota, urut, grand_total, cash_terima, cash_return, nama, hp, status, id_user, ppn)
    ('$nota', '$urut', '$grand_total', '$cash_terima2', '$cash_return', '$nama', '$hp2',1,'$id_user',$ppn)";
    mysqli_query($koneksi, $sql_insert_pembayaran) or die (include "error-message.php");
    $pembayaran_id = mysqli_insert_id($koneksi);
    $sql_update_
    header ("Location:../print-nota?nota=$nota");
?>