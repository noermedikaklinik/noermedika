<?php
    require_once "../akses.php";
    $id_user           = strtoupper($_POST['id_user']);
    $username          = strtoupper($_POST['username']);
    $nama              = strtoupper($_POST['nama']);
    $alamat            = strtoupper($_POST['alamat']);
    $email             = strtolower($_POST['email']);
    $nama_kontak       = strtoupper($_POST['nama_kontak']);
    $hp                = $_POST['hp'];
    $bank              = strtoupper($_POST['bank']);
    $jenis_kelamin     = strtoupper($_POST['jenis_kelamin']);

    $SQL = "INSERT INTO db_supplier (id_user,nama,alamat,hp,email,nama_kontak,bank,username,password,jenis_kelamin,activation_status)
    VALUES ('$id_user','$nama','$alamat','$hp','$email','$nama_kontak','$bank','$username','123456','$jenis_kelamin','1')";
    mysqli_query($koneksi, $SQL) or die (mysqli_error());
    header("location:../list-supplier?message=Supplier berhasil di tambahkan&alert=alert alert-success"); exit;

?>