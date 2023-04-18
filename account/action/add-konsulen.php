<?php
    include "../akses.php";
    $id_user           = strtoupper($_POST['id_user']);
    $username          = strtoupper($_POST['username']);
    $nama              = strtoupper($_POST['nama']);
    $alamat            = strtoupper($_POST['alamat']);
    $email             = strtolower($_POST['email']);
    $hp                = $_POST['hp'];
    $bank              = strtoupper($_POST['bank']);
    $jenis_kelamin     = strtoupper($_POST['jenis_kelamin']);

            
    $SQL = "INSERT INTO db_konsulen (id_user,nama,alamat,hp,email,bank,username,password,jenis_kelamin,activation_status,fee)
    VALUES ('$id_user','$nama','$alamat','$hp','$email','$bank','$username','123456','$jenis_kelamin','1','5')";
    mysqli_query($koneksi, $SQL) or die (mysqli_error());
    header("location:../konsulen-list?message=Konsulen berhasil di tambahkan&alert=alert alert-success"); exit;
?>