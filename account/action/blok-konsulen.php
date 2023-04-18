<?php
include "../akses.php";
$id_user = $_GET['id_user'];
$status  = $_GET['status'];

if ($status == "0"){$alert = "alert alert-danger";$message = "Konsulen diblokir";}
if ($status == "1"){$alert = "alert alert-success";$message = "Konsulen diaktifkan";}

$SQL = "UPDATE db_konsulen SET activation_status='$status' where id_user='$id_user'";
mysqli_query($koneksi, $SQL) or die (include "error-message.php");
header("location:../konsulen-list?message=$message&alert=$alert");
?>