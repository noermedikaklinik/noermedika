<?php
    require "../akses.php";
    $id_akun     = strtoupper($_POST['id_akun']);
    $nama        = strtoupper($_POST['nama']);
    $kategori    = strtoupper($_POST['kategori']);

    $sql  = mysqli_query($koneksi, "SELECT * FROM list_akun where kategori like '$kategori'") or die (mysql_error());
    $akun = mysqli_fetch_array($sql);
        
    $SQL = "INSERT INTO list_akun (no,id,name,kategori,jenis_akun)
    VALUES ('','$id_akun','$nama','$kategori','$akun[jenis_akun]')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysql_error());
        
    header ("Location:../add-coa?message=Akun COA Berhasil Ditambahkan&alert=alert alert-success");
?>