<?php
    require_once("../akses.php");
    $id_pendaftaran = $koneksi -> real_escape_string($_GET['id_pendaftaran']);
    $poli = $koneksi -> real_escape_string($_GET['poli']);
    $query_select = mysqli_query($koneksi, "SELECT tindakan.* FROM db_pendaftaran_tindakan tindakan 
                            INNER JOIN db_dokter dokter on dokter.no = tindakan.id_dokter
                            WHERE tindakan.id_pendaftaran = $id_pendaftaran AND dokter.poli = '$poli'") or die(mysqli_error($koneksi));
    $tindakan = mysqli_fetch_array($query_select);
    $id_tindakan = $tindakan['no'];
    mysqli_query($koneksi, "UPDATE db_pendaftaran_tindakan SET is_done = 1 WHERE no = $id_tindakan") or die(mysqli_error($koneksi));
    header("location:../pendaftaran");
?>