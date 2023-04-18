<?php
include "akses.php";

if(isset($_POST['jenis'])){
	$jenis   = $_POST['jenis'];
}else{
	$jenis = null;
}
if(isset($_GET['jenis2'])){
	$jenis2  = $_GET['jenis2'];
}else{
	$jenis2 = null;
}
$tglnow  = date("Y-m-d");
$jamnow  = date("H:i:s");

if ($jenis == "new-account")
{
}


if ($jenis == "edit-user-account")
{

}

if ($jenis2 == "blok-user")
{
$id_user = $_GET['id_user'];
$status  = $_GET['status'];

if ($status == "0"){$alert = "alert alert-danger";$message = "User Account Blocked";}
if ($status == "1"){$alert = "alert alert-success";$message = "User Account Activated";}

$SQL = "UPDATE db_user SET activation_status='$status' where id_user='$id_user'";
mysql_query($SQL, $koneksi) or die (include "error-message.php");
header("location:account-list?message=$message&alert=$alert");
}

if ($jenis == "edit-account")
{
$hp        = $_POST['hp'];

$SQL = "UPDATE db_user SET hp='$hp' where id_user='$row[id_user]'";
mysql_query($SQL, $koneksi) or die (include "error-message.php");
header("location:my-account?message=Your Account Updated Succesfullly Completed&alert=alert alert-success");
}

if ($jenis == "account-change-password")
{
$old_password  = $_POST['old_password'];
$new_password1 = $_POST['new_password1'];
$new_password2 = $_POST['new_password2'];

$result1 = mysqli_query($koneksi, "SELECT * FROM db_user where id_user like '$row[id_user]'");
$user    = mysqli_fetch_assoc($result1);

if ($old_password <> $user[password]){header("location:change-password?message=You Have Wrong Old Password");exit;}
if ($new_password1 <> $new_password2){header("location:change-password?message=You Must Repeat Same New Password");exit;}

$SQL = "UPDATE db_user SET password='$new_password1' where id_user='$row[id_user]'";
mysql_query($SQL, $koneksi) or die (include "error-message.php");
header("location:change-password?message=Password Succesfully Changed");
}



if ($jenis2 == "batalkan-trx")
{
$nota     = $_GET['nota'];

$SQL = "UPDATE db_penjualan SET status='0' where nota='$nota'";
mysql_query($SQL, $koneksi) or die (include "error-message.php");
header("location:list-nota?message=Pembatalan nota berhasil&alert=alert alert-success");
}



if ($jenis == "tambah-jasa")
{
}

if ($jenis == "edit-jasa")
{
$no        = $_POST['no'];
$nama_jasa = ucwords($_POST['nama_jasa']);
$harga     = preg_replace("/[^0-9]/", "", $_POST['harga']);

$SQL = "UPDATE db_jasa SET nama_jasa='$nama_jasa', harga='$harga' where no='$no'";
mysql_query($SQL, $koneksi) or die (include "error-message.php");
header("location:edit-jasa?message=Data produk jasa berhasil diupdate&alert=alert alert-success&no=$no");
}



if($jenis2 == "del-jurnal")
{
$no        = $_GET['no'];
$jurnalno  = $_GET['jurnalno'];
$sql  = "DELETE FROM mutasi WHERE no LIKE '$no'";	
$qry  = mysql_query($sql, $koneksi) or die ("Query Gagal ".mysql_error());

header ("Location:keuangan?jurnalno=$jurnalno&message=Jurnal berhasil dibatalkan&alert=alert alert-success");
}


if ($jenis == "new-konsulen")
{
}

if ($jenis == "new-supplier")
{
}


if ($jenis == "edit-supplier")
{
$id_user           = strtoupper($_POST['id_user']);
$nama              = strtoupper($_POST['nama']);
$alamat            = strtoupper($_POST['alamat']);
$email             = strtolower($_POST['email']);
$nama_kontak       = strtoupper($_POST['nama_kontak']);
$bank              = strtoupper($_POST['bank']);
$hp                = $_POST['hp'];
$jenis_kelamin     = strtoupper($_POST['jenis_kelamin']);

$SQL = "UPDATE db_supplier SET hp='$hp', alamat='$alamat', email='$email', jenis_kelamin='$jenis_kelamin', bank='$bank', nama_kontak='$nama_kontak' where id_user='$id_user'";
mysql_query($SQL, $koneksi) or die (include "error-message.php");
header("location:edit-supplier?message=Data suppplier berhasil diupdate&id_user=$id_user&alert=alert alert-success");
}
?>





















