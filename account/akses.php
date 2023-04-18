<?php 
date_default_timezone_set('Asia/Ujung_Pandang');
include dirname(__DIR__)."/configuration/koneksi.php";
session_start();

if(!isset($_SESSION['guest']))
{
echo '<script language="javascript">document.location="../?message=Silahkan Login terlebih Dahulu";</script>';
}
$result  = mysqli_query($koneksi, "SELECT * FROM db_user where username like '$_SESSION[guest]'");
$akses     = mysqli_fetch_assoc($result);
?>
