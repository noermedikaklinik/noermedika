<?php

    require_once "./akses.php";
    echo '
    <tr class="header" height="50" style="background:#1d3565;color:white;">
        <th style="width:5%;padding:10px;"><center>No</center></th>
        <th style="width:65%;padding:10px;"><center>Pasien</center></th>
        <th style="width:10%;padding:10px;"><center>Bayar</center></th>
    </tr>';
    $filter = isset($_GET['filter'])?$_GET['filter']:date("Y-m-d");
	$query_pendaftaran= mysqli_query($koneksi,"select db_pendaftaran.*, nama, no_rekam_medis, no_hp from db_pendaftaran 
    inner join db_pasien on db_pendaftaran.id_pasien = db_pasien.no 
    where tanggal = '$filter'") or die(mysqli_error($koneksi));
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
        $umum = $data_pendaftaran!= null?$data_pendaftaran['umum']:null;
        $gigi = $data_pendaftaran!= null?$data_pendaftaran['gigi']:null;
        $laboratorium = $data_pendaftaran!= null?$data_pendaftaran['laboratorium']:null;
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
                <a href='./action/kasir-add-pendaftaran.php?id_pendaftaran=$no' class='btn btn-success'>
                    Bayar
                </a>
            </td>";
        echo "</tr>";
  }
?>