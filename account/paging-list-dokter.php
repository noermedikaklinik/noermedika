<?php
    require_once "./akses.php";
    echo '
    <tr class="header" height="50" style="background:#1d3565;color:white;">
        <th style="width:5%;padding:10px;"><center>No</center></th>
        <th style="width:65%;padding:10px;"><center>Pasien</center></th>
        <th style="width:10%;padding:10px;"><center>Periksa</center></th>
        <th style="width:10%;padding:10px;"><center>Resep</center></th>
    </tr>';
    $filter = isset($_GET['filter'])?$_GET['filter']:date("Y-m-d");
    $poliQuery = mysqli_query($koneksi, "SELECT poli FROM db_dokter dokter where id_user = '$id_user'") or die(mysqli_error($koneksi));
    $poliRow = mysqli_fetch_array($poliQuery);
    $poli = $poliRow["poli"];
	$query_pendaftaran= mysqli_query($koneksi,"SELECT pendaftaran.*, pasien.nama, no_rekam_medis, no_hp from db_pendaftaran pendaftaran
    INNER JOIN db_pendaftaran_tindakan tindakan ON tindakan.id_pendaftaran = pendaftaran.no
    INNER JOIN db_dokter dokter ON dokter.no = tindakan.id_dokter
    INNER JOIN db_pasien pasien ON pendaftaran.id_pasien = pasien.no 
    where tanggal = '$filter' AND dokter.id_user = '$id_user'") or die(mysqli_error($koneksi));
    if(mysqli_num_rows($query_pendaftaran) ==0){
        echo "
        "?>
        <tr>
            <td colspan=5 class="text-center">Data Not Found</td>
        </tr>
        <?php
        "";
    }
	while($record = mysqli_fetch_array($query_pendaftaran)){
        mysqli_next_result($koneksi);
        $data = $record;
        $no = $data['no'];
        $query = mysqli_query($koneksi, 'CALL `PENDAFTARAN_BY_no_pendaftaran`('.$no.')') or die(mysqli_error($koneksi));
        $data_pendaftaran = mysqli_fetch_array($query);
        $status = null;
        $umum = $data_pendaftaran!= null?$data_pendaftaran['umum']:null;
        $gigi = $data_pendaftaran!= null?$data_pendaftaran['gigi']:null;
        $laboratorium = $data_pendaftaran!= null?$data_pendaftaran['laboratorium']:null;
        if($poli == "UMUM") $status = $umum;
        else if($poli == "GIGI") $status = $gigi;
        else $status = $laboratorium;
        echo "
        <tr>
            <td><center>$data[no]</center></td>
            <td>
                <div class='row'>
                    <div class='col-sm-2'>Nama pasien</div>
                    <div class='col-sm'>: $data[nama]</div>
                </div>
                <div class='row'>
                    <div class='col-sm-2'>No Rekam Medis</div>
                    <div class='col-sm'>: $data[no_rekam_medis]</div>
                </div>
                <div class='row'>
                    <div class='col-sm-2'>No. HP</div>
                    <div class='col-sm'>: $data[no_hp]</div>
                </div>
            </td>
            <td class='text-center'>
                <a href='dokter-periksa.php?id_pendaftaran=$no' class='btn btn-success'>
                    Pemeriksaan
                </a>
            </td>
            <td>
                <a href='dokter-resep.php?id_pendaftaran=$no' class='btn btn-success'>
                    Resep
                </a>
            </td>
        </tr>";
  }
?>