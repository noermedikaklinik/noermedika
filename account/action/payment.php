<?php
    require "../akses.php";
    $nama          = strtoupper($_POST['nama']);
    $hp            = strtoupper($_POST['phone_number']);
    $cash_terima   = $_POST['cash_terima'];
    require_once('./count-total.php');
    
    if ($total > $cash_terima)  {header ("Location:../pembayaran?message=Nominal Pembayaran Tidak Sesuai&alert=alert alert-danger"); exit;}
    if ($total < $cash_terima)  {$cash_terima2 = $cash_terima;$cash_return   = $cash_terima - $total;}
    if ($total == $cash_terima) {$cash_terima2 = $cash_terima;$cash_return   = $cash_terima - $total;}

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
    (nota, urut, grand_total,cash_terima,cash_return,nama,hp,status,id_user,ppn, tanggal) VALUES 
    ('$nota', $urut, $total,$cash_terima, $cash_return, '$nama', '$hp', 1, $id_user, $ppn, '$now')";
    mysqli_query($koneksi, $sqlInsertPembayaran) or die(mysqli_error($koneksi));
    $idPembayaran = mysqli_insert_id($koneksi);
    $updatePenjualan = "UPDATE db_penjualan SET status=1, id_pembayaran=$idPembayaran,nota='$nota' WHERE status=0";
    mysqli_query($koneksi, $updatePenjualan) or die(mysqli_error($koneksi));
    header("location:../print-nota?nota=$nota");
?>