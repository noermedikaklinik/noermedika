<?php
include "../akses.php";
$id_user = $_GET['id_user'];
$status  = $_GET['status'];

if ($status == "0"){$alert = "alert alert-danger";$message = "Akun diblokir";}
if ($status == "1"){$alert = "alert alert-success";$message = "Akun diaktifkan";}

$SQL = "UPDATE tb_user SET activation_status='$status' where id_user='$id_user'";
mysqli_query($koneksi, $SQL) or die (include "error-message.php");
header("location:../list-account?message=$message&alert=$alert");
?>