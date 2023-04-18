<?php
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', 'logs/error.log');
date_default_timezone_set('Asia/Ujung_Pandang');

$tanggalskrg1  = date("Y-m-d");
$tanggalskrg2  = date("d-M-Y");
$jamskrg       = date("H:i:s");
?>

<center><font size="3" color="#3399FF" name="tahoma"><b><?php echo "$tanggalskrg2"; ?> | <?php echo "$jamskrg"; ?></font></center>