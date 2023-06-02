<?php 
date_default_timezone_set('Asia/Ujung_Pandang');
include dirname(__DIR__)."/configuration/koneksi.php";
session_start();

if(!isset($_SESSION['guest']))
{
echo '<script language="javascript">document.location="../?message=Silahkan Login terlebih Dahulu";</script>';
}
$result  = mysqli_query($koneksi, "SELECT * FROM tb_user where username = '$_SESSION[guest]'");
$akses     = mysqli_fetch_assoc($result);
$id_user = $akses['no'];
$query_dokter = mysqli_query($koneksi, "SELECT * FROM db_dokter where id_user='$id_user'");
if($dokter = mysqli_fetch_array($query_dokter)){
    $nama_dokter = $dokter['nama'];
    $poli_dokter = $dokter['poli'];
}
?>
