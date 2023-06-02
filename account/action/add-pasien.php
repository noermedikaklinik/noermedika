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

            
    $SQL = "INSERT INTO db_pasien (no_rekam_medis, nik, nama, alamat, tempat_lahir, tanggal_lahir, no_hp, pekerjaan)
    VALUES ('$no_rekam_medis','$nik','$nama','$alamat','$tempat_lahir','$tanggal_lahir','$no_hp','pekerjaan')";
    mysqli_query($koneksi, $SQL) or die (mysqli_error());
    header("location:../pendaftaran?message=Pasien berhasil di tambahkan&alert=alert alert-success"); exit;
?>