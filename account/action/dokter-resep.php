<?php
    require_once("../akses.php");
    try{
        $id_pasien = $koneksi -> real_escape_string($_POST["id_pasien"]);
        $resep = $koneksi -> real_escape_string($_POST["resep"]);
        $id_pendaftaran= $koneksi -> real_escape_string($_POST['id_pendaftaran']);
        $query_dokter = mysqli_query($koneksi, "SELECT * FROM db_dokter WHERE id_user = '$id_user'") or die(mysqli_error($koneksi));
        if($dokter = mysqli_fetch_array($query_dokter)){
            $id_dokter = $dokter['no'];
            $nama_dokter = $dokter['nama'];
            $nama_poli = $dokter['poli'];
        }else{
            throw new Exception("Dokter Not Found");
        }
        mysqli_query($koneksi, "INSERT INTO db_resep 
                                (id_dokter, id_pendaftaran, id_pasien, nama_dokter, poli, resep) VALUES 
                                ($id_dokter, $id_pendaftaran, $id_pasien, '$nama_dokter', '$nama_poli', '$resep')") or die(mysqli_error($koneksi));
        mysqli_query($koneksi, "UPDATE db_pendaftaran_tindakan SET is_done = 1 WHERE id_pendaftaran=$id_pendaftaran AND id_dokter='$id_dokter'") or die(mysqli_error($koneksi));
        Header("Location:../dokter");
    }catch(Exception $e){
        return $e.getMessage();
    }
?>