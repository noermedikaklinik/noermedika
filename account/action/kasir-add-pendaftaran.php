<?php
    require "../akses.php";
    $id_pendaftaran = $_GET['id_pendaftaran'];
    //update all resep to 0 by id pendaftaran
    $updateResepQuery = "UPDATE db_resep SET status = 1 where id_pendaftaran = $id_pendaftaran";
    mysqli_query($koneksi, $updateResepQuery);
    
    //update pendaftaran is paid
    $updatePendaftaranQuery = "UPDATE db_pendaftaran SET is_paid=1 WHERE no=$id_pendaftaran";
    mysqli_query($koneksi, $updatePendaftaranQuery);
    header("Location:../kasir.php");
    //add harga pemeriksaan
?>
