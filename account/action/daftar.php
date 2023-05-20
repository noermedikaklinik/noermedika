<?php
    require_once "../akses.php";
    $no_rekam_medis = $_POST['no_rekam_medis'];
    $tanggal = $_POST['tanggal'];
    $umum = $_POST['umum'];
    $gigi = $_POST['gigi'];
    echo $tanggal;
    $laboratorium = $_POST['laboratorium'];
    
    $pasien_query = mysqli_query($koneksi, "SELECT no FROM db_pasien WHERE no_rekam_medis = '$no_rekam_medis'") or die(mysqli_error($koneksi));
    $pasien = mysqli_fetch_array($pasien_query);

    $last_urut_query = mysqli_query($koneksi, "SELECT max(urut) as urutan_terakhir from db_pendaftaran where tanggal='$tanggal'") or die(mysqli_error($koneksi));
    $last_urut = mysqli_fetch_array($last_urut_query);
    $urut = $last_urut == null ? 1 : $last_urut['urutan_terakhir']+1;
    mysqli_begin_transaction($koneksi);
    try {
        mysqli_query($koneksi, "INSERT INTO db_pendaftaran(id_pasien, tanggal, urut) VALUES ($pasien[no], '$tanggal', $urut)") or die(mysqli_error($koneksi));
        $id = mysqli_insert_id($koneksi);
        if($umum != "") mysqli_query($koneksi, "INSERT INTO db_pendaftaran_tindakan(id_pendaftaran, id_dokter, is_done) VALUEs ($id, $umum, 0)");
        if($gigi != "") mysqli_query($koneksi, "INSERT INTO db_pendaftaran_tindakan(id_pendaftaran, id_dokter, is_done) VALUEs ($id, $gigi, 0)");
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