<?php

    require_once dirname(__DIR__)."/akses.php";
    echo '<tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:30%;padding:10px;">Nama</th>
    <th style="width:10%;padding:10px;">Harga</th>
    <th style="width:7%;padding:10px;"><center>Action</center></th>
  </tr>';
	$data_produk= mysqli_query($koneksi,"select * from db_jasa order by nama_jasa asc");
    $no = 0;
	while($record = mysqli_fetch_array($data_produk)){
        $no++;
        
        $harga_belirp  = number_format($record['harga'],0,",",".");
        echo "

        <tr>
            <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>$record[nama_jasa]</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $harga_belirp</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>
                <center>
                    <a href='../account/action/kasir-add-jasa.php?no=$record[no]'><i class='fa fa-plus-circle' style='color:green;font-size:20px;'></i></a>
                </center>
            </td>
        </tr>";
  }
?>