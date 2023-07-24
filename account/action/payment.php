<?php
    require "../akses.php";
    $nama          = strtoupper($_POST['nama']);
    $hp            = strtoupper($_POST['phone_number']);
    $cash_terima   = $_POST['cash_terima'];
    require_once('./count-total.php');
    
    if ($grand_total > $cash_terima)  {header ("Location:../pembayaran?message=Nominal Pembayaran Tidak Sesuai&alert=alert alert-danger"); exit;}
    if ($grand_total < $cash_terima)  {$cash_terima2 = $cash_terima;$cash_return   = $cash_terima - $grand_total;}
    if ($grand_total == $cash_terima) {$cash_terima2 = $cash_terima;$cash_return   = $cash_terima - $grand_total;}

    $now   = date("Y-m-d");
    $nowString = date("Ymd");
    $result1   = mysqli_query($koneksi, "SELECT urut FROM db_pembayaran WHERE tanggal = '$now' order by urut desc");
    $trx       = mysqli_fetch_assoc($result1);
    $urut      = $trx['urut'] + 1;
    if($urut <10){
        $formattedUrut = "000{$urut}";
    }else if($urut <100){
        $formattedUrut = "00{$urut}";
    }else if($urut < 1000){
        $formattedUrut = "0{$urut}";
    }else{
        $formattedUrut = $urut;
    }
    $nota = "{$nowString}APT{$formattedUrut}";
    $sqlInsertPembayaran = "INSERT INTO db_pembayaran 
    (nota, urut, total,grand_total,cash_terima,cash_return,nama,hp,status,id_user,ppn, tanggal) VALUES 
    ('$nota', $urut, $total,$grand_total,$cash_terima, $cash_return, '$nama', '$hp', 1, $id_user, $ppn, '$now')";
    mysqli_query($koneksi, $sqlInsertPembayaran) or die(mysqli_error($koneksi));
    $idPembayaran = mysqli_insert_id($koneksi);
    
    #penjualan dengan status 0 adalah pembayaran yang belum dibayar
    $updatePenjualan = "UPDATE db_penjualan SET status=2, id_pembayaran=$idPembayaran,nota='$nota' WHERE status=0";
    mysqli_query($koneksi, $updatePenjualan) or die(mysqli_error($koneksi));

    #pendaftaran dengan status 1 adalah pembayaran yang sedang dibayar
    $updatePendaftaran = "UPDATE db_pendaftaran SET is_paid=2, id_pembayaran=$idPembayaran WHERE is_paid=1";
    mysqli_query($koneksi, $updatePendaftaran) or die(mysqli_error($koneksi));

    #resep dengan status 1 adalah resep yang sedang di bayar
    $updateResep = "UPDATE db_resep SET status = 2 WHERE status = 1";
    mysqli_query($koneksi, $updateResep);
    header("location:../print-nota?nota=$nota");
?>