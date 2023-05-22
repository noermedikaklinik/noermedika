<?php
include "configuration/koneksi.php";

session_start();

$user  = $koneksi->mysqli_real_escape_string($_POST['username']);
$pass  = $koneksi->mysqli_real_escape_string($_POST['password']);

$sql = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$user' AND password='$pass' and activation_status='1'") or die (include "error-message.php");

if(mysqli_num_rows($sql) == 0)
{
    header ("Location:./?message=Username atau Password Salah");
}
if(mysqli_num_rows($sql) == 1)
{
    $_SESSION['guest']=$user;
    header ("Location:account/");
}
?>