<?php
    include "../akses.php";
    $id_user           = strtoupper($_POST['id_user']);
    $nama              = strtoupper($_POST['nama']);
    $alamat            = strtoupper($_POST['alamat']);
    $email             = strtolower($_POST['email']);
    $bank              = strtoupper($_POST['bank']);
    $hp                = $_POST['hp'];
    $jenis_kelamin     = strtoupper($_POST['jenis_kelamin']);


    $SQL = "UPDATE db_konsulen SET hp='$hp', alamat='$alamat', email='$email', jenis_kelamin='$jenis_kelamin', bank='$bank' where id_user='$id_user'";
    mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    header("location:../edit-konsulen?message=Data konsulen berhasil diupdate&id_user=$id_user&alert=alert alert-success");
?>