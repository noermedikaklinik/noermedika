<?php

    require_once dirname(__DIR__)."/akses.php";
    echo '<tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:10%;padding:10px;"><center>Nama Pasien</center></th>
    <th style="width:30%;padding:10px;">Nama Dokter</th>
    <th style="width:10%;padding:10px;">Poli</th>
    <th style="width:10%;padding:10px;">Status</th>
    <th style="width:7%;padding:10px;"><center>Action</center></th>
  </tr>';
    $size = isset($_GET['size'])?$_GET['size']:20;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $start = ($halaman-1)*$size;

	$data_resep= mysqli_query($koneksi,"SELECT db_resep.*, db_pasien.nama as nama_pasien FROM db_resep 
                            INNER JOIN db_pasien on db_resep.id_pasien = db_pasien.no 
                            WHERE status = 0
                            order by tanggal asc limit $start, $size") or die(mysqli_error($koneksi));
    $no = ($size*($halaman-1));
    if(mysqli_num_rows($data_resep) == 0){
        echo "
            <tr>
                <td colspan=6>Tidak ada resep yang belum terbayar</td>
            </tr>
        ";
    }
	while($record = mysqli_fetch_array($data_resep)){
        $no++;
        if($record['status'] == 0){
            $status = "<div class='text-primary'>Belum Terbayar</div>";
        }else if($record['status']==1){
            $status = "<div class='text-secondary'>Dalam Pembayaran</div>";
        }else{
            $status = "<div class='text-success'>Telah dibayar</div>";
        }
        echo "
        <tr>
            <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>$record[nama_pasien]</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>$record[nama_dokter]</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>$record[poli]</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>$status</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>
                <center>
                    <a tooltip='Bayar resep' href='./action/edit-resep.php?id_resep=$record[no]&status=1'>
                        <i class='fa fa-plus text-success'></i>
                    </a>
                </center>
            </td>
        </tr>";
  }
?>