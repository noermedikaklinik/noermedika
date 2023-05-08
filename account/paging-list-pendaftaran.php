<?php

    require_once "./akses.php";
    echo '
    <tr class="header" height="50" style="background:#1d3565;color:white;">
        <th style="width:5%;padding:10px;"><center>No</center></th>
        <th style="width:65%;padding:10px;"><center>Pasien</center></th>
        <th style="width:10%;padding:10px;"><center>Poli Umum</center></th>
        <th style="width:10%;padding:10px;"><center>Poli Gigi</center></th>
        <th style="width:10%;padding:10px;"><center>Laboratorium</center></th>
    </tr>';
    $filter = isset($_GET['filter'])?$_GET['filter']:date("Y-m-d");
	$data_produk= mysqli_query($koneksi,"select * from db_pendaftaran 
    inner join db_pasien on db_pendaftaran.id_pasien = db_pasien.no
    where tanggal = '$filter'") or die(mysqli_error($koneksi));
	while($record = mysqli_fetch_array($data_produk)){
        echo "
        <tr>
            <td style='border:1px solid #d1d1d1;padding:10px;'><center>$record[no]</center></td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>
                <div class='row'>
                    <div class='col-sm-2'>Nama pasien</div>
                    <div class='col-sm'>: $record[nama]</div>
                </div>
                <div class='row'>
                    <div class='col-sm-2'>No Rekam Medis</div>
                    <div class='col-sm'>: $record[no_rekam_medis]</div>
                </div>
                <div class='row'>
                    <div class='col-sm-2'>No. HP</div>
                    <div class='col-sm'>: $record[no_hp]</div>
                </div>
            </td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>
                <center>
                    <a tooltip='Update Informasi Barang' flow='left' href='edit-pasien?no=$record[no]'>
                        <i class='fa fa-pencil' style='color:orange;font-size:18px;'></i>
                    </a>
                </center>
            </td>
        </tr>";
  }
?>