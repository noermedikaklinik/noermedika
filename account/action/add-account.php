<?php
    require "../akses.php";
$id_user           = strtoupper($_POST['id_user']);
$username          = strtoupper($_POST['username']);
$nama              = strtoupper($_POST['nama']);
$alamat            = strtoupper($_POST['alamat']);
$email             = strtolower($_POST['email']);
$hp                = $_POST['hp'];
$jabatan           = strtoupper($_POST['jabatan']);
$jenis_kelamin     = strtoupper($_POST['jenis_kelamin']);
$doc1              = $_FILES['doc1']['name'];
$ukuran            = $_FILES['doc1']['size'];
$ext1              = pathinfo($doc1, PATHINFO_EXTENSION);
$ekstensi          =  array('png','jpg','jpeg');

if ($jabatan == "APOTEKER" or $jabatan == "ASISTEN APOTEKER"){$fee = "5";} else {$fee = "0";}

if(!in_array($ext1,$ekstensi) ) { 
    header ("Location:add-new-account?message=Extension Not Allowed&&alert=alert alert-danger");
}
else
{
	if ($ukuran < 1110440700)
	{		
		$filename = $id_user.'_'.$doc1;
		move_uploaded_file($_FILES['doc1']['tmp_name'], '../staff-image/'.$id_user.'_'.$doc1);
		
		$SQL = "INSERT INTO db_user (id_user,nama,alamat,hp,email,jabatan,username,password,jenis_kelamin,foto,activation_status,fee)
		VALUES ('$id_user','$nama','$alamat','$hp','$email','$jabatan','$username','123456','$jenis_kelamin','$filename','1','$fee')";
		mysqli_query($koneksi, $SQL) or die (mysqli_error());
		header("location:../account-list?message=New User Has Been Added&alert=alert alert-success"); exit;
	}
	else
	{
	header ("Location:../add-new-account?message=File size too big&alert=alert alert-warning");
	}
}
?>