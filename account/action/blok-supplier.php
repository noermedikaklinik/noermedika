<?php
include "../akses.php";
$id_user = $_GET['id_user'];
$status  = $_GET['status'];

if ($status == "0"){$alert = "alert alert-danger";$message = "User Account Blocked";}
if ($status == "1"){$alert = "alert alert-success";$message = "User Account Activated";}

$SQL = "UPDATE db_supplier SET activation_status='$status' where id_user='$id_user'";
mysqli_query($koneksi, $SQL) or die (include "error-message.php");
header("location:../supplier-list?message=$message&alert=$alert");
?>