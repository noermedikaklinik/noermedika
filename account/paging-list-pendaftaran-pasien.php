<?php

    require_once "./akses.php";
    echo '
    <tr class="header" height="50" style="background:#1d3565;color:white;">
        <th style="width:5%;padding:10px;"><center>No</center></th>
        <th style="width:75%;padding:10px;"><center>Pasien</center></th>
        <th style="width:20%;padding:10px;"><center>Action</center></th>
    </tr>';
    $size = isset($_GET['size'])?$_GET['size']:20;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $filter = isset($_GET['filter'])?$_GET['filter']:"";
    $where = isset($_GET['filter'])?"where no_rekam_medis like '%$filter%' or nama like '%$filter%'":"";
    $start = ($halaman-1)*$size;
	$data_produk= mysqli_query($koneksi,"select * from db_pasien $where order by nama asc limit $start, $size");
    $no = ($size*($halaman-1));
	while($record = mysqli_fetch_array($data_produk)){

        echo "
        <script type='text/javaScript'>
            function edit_produk$no()          {window.location = 'edit-product?id_produk=$record[no]'}
            function add_stock_produk$no()     {window.location = 'add-stock-produk?id_produk=$record[no]'}
        </script>

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
                    <a tooltip='Daftar' flow='left' href='pendaftaran-tindakan?no_rekam_medis=$record[no_rekam_medis]'>
                        <i class='fa fa-plus' style='color:green;font-size:18px;'></i>
                    </a>
                </center>
            </td>
        </tr>";
  }
?>