<?php
    include "../akses.php";
    $no_rekam_medis           = strtoupper($_POST['no_rekam_medis']);
    $nik          = strtoupper($_POST['nik']);
    $nama          = strtoupper($_POST['nama']);
    $alamat              = strtoupper($_POST['alamat']);
    $tempat_lahir            = strtoupper($_POST['tempat_lahir']);
    $tanggal_lahir             = strtolower($_POST['tanggal_lahir']);
    $no_hp                = $_POST['no_hp'];
    $pekerjaan              = strtoupper($_POST['pekerjaan']);
    $no = strtoupper($_POST['no']);

            
    $SQL = "UPDATE db_pasien 
        SET 
        no_rekam_medis='$no_rekam_medis',
        nik = '$nik',
        nama = '$nama',
        alamat = '$alamat',
        tempat_lahir = '$tempat_lahir',
        tanggal_lahir = '$tanggal_lahir',
        no_hp = '$no_hp',
        pekerjaan = '$pekerjaan'
        where no='$no'
    ";
    mysqli_query($koneksi, $SQL) or die (mysqli_error($koneksi));
    header("location:../pendaftaran?message=Pasien berhasil di tambahkan&alert=alert alert-success"); 
?>