<?php
include "mainhead.php";
?>







<?php
	$data_pegawai = mysqli_query($link,"select * from db_penjualan");
	$nomor = $halaman_awal+1;
	while($record = mysqli_fetch_array($data_pegawai)){
	
	$kode = mt_rand(6,999999);
	$SQL = "UPDATE db_penjualan SET kode_trx='$kode' where nota='$record[nota]'";
    mysql_query($SQL, $koneksi) or die (include "error-message.php");

}

echo "OKE";
?>

