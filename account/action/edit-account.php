<?php
    require "../akses.php";
    $id_user           = strtoupper($_POST['id_user']);
    $username          = strtoupper($_POST['username']);
    $nama              = ucwords($_POST['nama']);
    $alamat            = ucwords($_POST['alamat']);
    $email             = strtolower($_POST['email']);
    $hp                = $_POST['hp'];
    $hak_akses         = strtoupper($_POST['hak_akses']);
    $sql_update = "UPDATE tb_user SET 
      username='$username', 
      nama='$nama', 
      hak_akses='$hak_akses', 
      alamat = '$alamat',
      email = '$email',
      hp = '$hp'
      where id_user = '$id_user'";
      mysqli_query($koneksi, $sql_update) or die(mysqli_error($koneksi));
  header("Location:../list-account");
    
?>