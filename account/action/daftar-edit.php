<?php
    require_once("../akses.php");
    $umum = $koneksi -> real_escape_string($_POST['umum']);
    $gigi = $koneksi -> real_escape_string($_POST['gigi']);
    $labor = $koneksi -> real_escape_string($_POST['laboratorium']);
    $id = $koneksi -> real_escape_string($_POST['id_pendaftaran']);
    mysqli_begin_transaction($koneksi);
    try {
        mysqli_query($koneksi, "DELETE FROM db_pendaftaran_tindakan WHERE id_pendaftaran = '$id'") or die(mysqli_error($koneksi));
        if($umum != "") mysqli_query($koneksi, "INSERT INTO db_pendaftaran_tindakan(id_pendaftaran, id_dokter, is_done) VALUEs ($id, $umum, 0)") or die(mysqli_error($koneksi));
        if($gigi != "") mysqli_query($koneksi, "INSERT INTO db_pendaftaran_tindakan(id_pendaftaran, id_dokter, is_done) VALUEs ($id, $gigi, 0)") or die(mysqli_error($koneksi));
        if($laboratorium=="true"){
            $laboratorium_query = mysqli_query($koneksi, "SELECT * FROM db_dokter where poli = 'LABORATORIUM'") or die(mysqli_error($koneksi));
            $laboratorium = mysqli_fetch_array($laboratorium_query);
            mysqli_query($koneksi, "INSERT INTO db_pendaftaran_tindakan(id_pendaftaran, id_dokter, is_done) VALUEs ($id, $laboratorium[no], 0)");
        }
        mysqli_commit($koneksi);
        header("location:../pendaftaran");

    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($mysqli);

        throw $exception;
    }
?>