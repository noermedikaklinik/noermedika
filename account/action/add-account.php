<?php
    require "../akses.php";
$id_user           = strtoupper($_POST['id_user']);
$username          = strtoupper($_POST['username']);
$nama              = strtoupper($_POST['nama']);
$alamat            = strtoupper($_POST['alamat']);
$email             = strtolower($_POST['email']);
$hp                = $_POST['hp'];
$hak_akses           = strtoupper($_POST['hak_akses']);


$SQL = "INSERT INTO tb_user (id_user,nama,alamat,hp,email,hak_akses,username,password,activation_status)
VALUES ('$id_user','$nama','$alamat','$hp','$email','$hak_akses','$username','123456',1)";
mysqli_query($koneksi, $SQL) or die (mysqli_error($koneksi));
header("location:../list-account?message=New User Has Been Added&alert=alert alert-success"); exit;

?>