<?php
include "akses.php";
if ($akses['jabatan'] <> "KEUANGAN"){header("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";
?>

<style>
  
</style>

<div style="height:110px;"></div>


<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2"><font size="4" color="#5b8ff5"><b>Data Persediaan Barang</b></font></td></tr>
    <td colspan="3" height="40">&nbsp;</td></tr>
    <td align="left" width="85%"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="pencarian data barang..." autofocus></td>
    <td align="right" width="15%"><a href="add-new-product" tooltip='Tambah item baru' flow='left'><i class="fa fa-plus-circle" style="color:green;font-size:35px;"></i></a> &nbsp; &nbsp; &nbsp; <a href='mutasi-stock-product' tooltip='Riwayat Barang Masuk' flow='left' ><i class='fa fa-exchange' style='color:red;font-size:30px;'></i></a></td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:10%;padding:10px;"><center>Foto</center></th>
    <th style="width:30%;padding:10px;">Nama</th>
    <th style="width:10%;padding:10px;">Harga Beli Satuan</th>
    <th style="width:10%;padding:10px;">Harga Jual Satuan</th>
    <th style="width:10%;padding:10px;">Persediaan</th>
    <th style="width:10%;padding:10px;">Minimum</th>
    <th style="width:7%;padding:10px;"><center>Action</center></th>
  </tr>

<?php
	$batas = 1000;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
	$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
 
	$previous = $halaman - 1;
	$next = $halaman + 1;
				
	$data = mysqli_query($koneksi,"select * from db_produk order by no asc");
	$jumlah_data = mysqli_num_rows($data);
	$total_halaman = ceil($jumlah_data / $batas);
	
	$data_produk= mysqli_query($koneksi,"select * from db_produk order by no asc limit $halaman_awal, $batas");
	$nomor = $halaman_awal+1;
  $no = 1;
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

    <td colspan="11" align="right">
		<nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Prev</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
	</div>
	</td>
</table>

<div style="height:35px;"></div>
    
</td>
</table>

<div style="height:45px;"></div>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<script src="../link/myjs.js"></script>








