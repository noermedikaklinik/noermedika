<?php
    require_once("../akses.php");
    try{
        $id_pasien = $koneksi -> real_escape_string($_POST["id_pasien"]);
        $diagnosa = $koneksi -> real_escape_string($_POST["diagnosa"]);
        $anamnesa = $koneksi -> real_escape_string($_POST["anamnesa"]);
        $pemeriksaan_fisik = $koneksi -> real_escape_string($_POST["pemeriksaan_fisik"]);
        $terapi = $koneksi -> real_escape_string($_POST["terapi"]);
        $id_pendaftaran= $koneksi -> real_escape_string($_POST['id_pendaftaran']);
        $query_dokter = mysqli_query($koneksi, "SELECT * FROM db_dokter WHERE id_user = '$id_user'") or die(mysqli_error($koneksi));
        if($dokter = mysqli_fetch_array($query_dokter)){
            $id_dokter = $dokter['no'];
        }else{
            throw new Exception("Dokter Not Found");
        }
        mysqli_query($koneksi, "INSERT INTO db_pemeriksaan 
                                (id_pasien, nama_dokter, poli, tanggal,  diagnosa, anamnesa, pemeriksaan_fisik, terapi) VALUES 
                                ($id_pasien, '$nama_dokter', '$poli_dokter', now(), '$diagnosa', '$anamnesa', '$pemeriksaan_fisik', '$terapi')") or die(mysqli_error($koneksi));
        mysqli_query($koneksi, "UPDATE db_pendaftaran_tindakan SET is_done = 1 WHERE id_pendaftaran=$id_pendaftaran AND id_dokter='$id_dokter'") or die(mysqli_error($koneksi));
        Header("Location:../dokter");
    }catch(Exception $e){
        return $e.getMessage();
    }
?>