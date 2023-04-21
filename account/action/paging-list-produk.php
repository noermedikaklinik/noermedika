<?php

    require_once dirname(__DIR__)."/akses.php";
    echo '<tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:10%;padding:10px;"><center>Foto</center></th>
    <th style="width:30%;padding:10px;">Nama</th>
    <th style="width:10%;padding:10px;">Harga Beli Satuan</th>
    <th style="width:10%;padding:10px;">Harga Jual Satuan</th>
    <th style="width:10%;padding:10px;">Persediaan</th>
    <th style="width:10%;padding:10px;">Minimum</th>
    <th style="width:7%;padding:10px;"><center>Action</center></th>
  </tr>';
    $size = isset($_GET['size'])?$_GET['size']:20;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $filter = isset($_GET['filter'])?$_GET['filter']:"";
    $where = isset($_GET['filter'])?"where id_produk like '%$filter%' or nama_produk like '%$filter%'":"";
    $start = ($halaman-1)*$size;
	$data_produk= mysqli_query($koneksi,"select * from db_produk $where order by nama_produk asc limit $start, $size");
    $no = ($size*($halaman-1));
	while($record = mysqli_fetch_array($data_produk)){
        $no++;
        $sqlpengunjung    = "select sum(qty) kunjung from db_penjualan where id_produk = '$record[id_produk]' and status = '1'";
        $resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
        $pengunjung1      = mysqli_fetch_object($resultpengunjung);
        $terjual          = $pengunjung1->kunjung;
        $terjualrp        = number_format($terjual,0,",",".");

        $min_stokrp  = number_format($record['min_stok'],0,",",".");
        $harga_belirp  = number_format($record['harga_beli'],0,",",".");
        $harga_jualrp  = number_format($record['harga_jual'],0,",",".");

        $sqlpengunjung    = "select sum(jumlah) kunjung from db_stock_produk where id_produk = '$record[id_produk]'";
        $resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
        $pengunjung1      = mysqli_fetch_object($resultpengunjung);
        $jml_stock        = $pengunjung1->kunjung;
        $jml_stockrp      = number_format($jml_stock,0,",",".");

        $sqlpengunjung    = "select sum(qty) kunjung from db_penjualan where id_produk = '$record[id_produk]' and status = '1'";
        $resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
        $pengunjung2      = mysqli_fetch_object($resultpengunjung);
        $jml_terjual      = $pengunjung2->kunjung;
        $jml_terjualrp    = number_format($jml_terjual,0,",",".");

        $sisa_stock       = $jml_stock - $jml_terjual;
        $sisa_stockrp     = number_format($sisa_stock,0,",",".");

        echo "
        <script type='text/javaScript'>
            function edit_produk$no()          {window.location = 'edit-product?id_produk=$record[id_produk]'}
            function add_stock_produk$no()     {window.location = 'add-stock-produk?id_produk=$record[id_produk]'}
        </script>

        <tr>
            <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
            <td style='border:1px solid #d1d1d1;padding:10px;'><center><img src='produk-image/$record[foto]' style='width:65px;height:auto;border-radius:10px;'></center></td>
            <td style='border:1px solid #d1d1d1;padding:10px;'><b>Kode Barang : $record[id_produk]</b><br>$record[nama_produk]<br><i>$record[kategori_produk]</i><br><span style='color:green;font-weight:bold;'>Terjual : $terjualrp<span></td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $harga_belirp</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $harga_jualrp</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>$sisa_stockrp $record[satuan_produk]</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>$min_stokrp $record[satuan_produk]</td>
            <td style='border:1px solid #d1d1d1;padding:10px;'>
                <center>
                    <a tooltip='Update Informasi Barang' flow='left' ><i class='fa fa-pencil' style='color:orange;font-size:18px;' onclick='return edit_produk$no();'></i></a>
                    &nbsp; &nbsp;
                    <a tooltip='Update Stock Barang' flow='left' ><i class='fa fa-plus-circle' style='color:green;font-size:20px;' onclick='return add_stock_produk$no();'></i></a>
                </center>
            </td>
        </tr>";
  }
?>