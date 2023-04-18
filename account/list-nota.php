<?php
include "akses.php";
include "mainhead.php";

$tglnow = date("d-M-Y");
$jamnow = date("H:i");
?>

<table class ="table-main">
    
<?php include "dash-left-staff.php"; ?>

<td style="width:1%;"></td>

<td valign="top" style="width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2" ><font size="4" color="#5b8ff5"><b>Data Nota</b></font></td></tr>
    <td colspan="2" height="40">&nbsp;</td></tr>
    <td ><input type="text" id="myInput" onkeyup="myFunction()" placeholder="cari nomor nota..."></td>
    <td align="center" width="5%">&nbsp;</td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:0px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:13%;padding:10px;"><center>Tanggal</center></th>
    <th style="width:20%;padding:10px;">No Nota</th>
    <th style="width:12%;padding:10px;">Pembayaran</th>
    <th style="width:15%;padding:10px;">Nominal</th>
    <th style="width:11%;padding:10px;">Konsulen ID</th>
    <th style="width:11%;padding:10px;">Apoteker ID</th>
    <th style="width:11%;padding:10px;"><center>Aksi</center></th>
  </tr>

<?php
	$batas = 50;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
	$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
 
	$previous = $halaman - 1;
	$next = $halaman + 1;
				
	$data = mysqli_query($koneksi,"select * from db_penjualan where id_user like '$akses[id_user]' group by nota order by no asc");
	$jumlah_data = mysqli_num_rows($data);
	$total_halaman = ceil($jumlah_data / $batas);
	
	$data_pegawai = mysqli_query($koneksi,"select * from db_penjualan where id_user like '$akses[id_user]' group by nota order by no asc limit $halaman_awal, $batas");
	$nomor = $halaman_awal+1;
  $no = 1;
	while($record = mysqli_fetch_array($data_pegawai)){
    $sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where nota like '$record[nota]'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung3      = mysqli_fetch_object($resultpengunjung);
    $total_penjualan  = $pengunjung3->kunjung;
    $total_penjualanrp= number_format($total_penjualan,0,",",".");

    if ($record["status"] == "0"){$status_nota = "<span style='color:red;font-size:12px;'>(void)</span>";$button_status = "<a tooltip='Nota Transaksi Dibatalkan' flow='left' ><i class='fa fa-times' style='color:red;font-size:18px;'></i></a>";}
    if ($record["status"] == "1"){$status_nota = "";$button_status = "<a href='save-data?nota=$record[nota]&jenis2=batalkan-trx' tooltip='Batalkan Nota Transaksi' flow='left' ><i class='fa fa-check' style='color:green;font-size:18px;' onclick='return cek_del$no();'></i></a>";}

    echo "
    <script>
    function cek_del$no()
    {
        tanya = confirm('Anda ingin membatalkan transaksi nota $record[nota]  ?');
        if (tanya == true) return list_nota();
        else return false;
    }
    </script>

    <tr>
    <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
    <td align='center' style='border:1px solid #d1d1d1;padding:10px;'>$record[tanggal]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>$record[nota] $status_nota</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>$record[jenis_pembayaran]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $total_penjualanrp</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>$record[id_konsulen]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>$record[id_apoteker]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>
    <center>
    <a href='print-nota-2?nota=$record[nota]' tooltip='Cetak ulang nota' flow='left' ><i class='fa fa-print' style='color:black;font-size:18px;'></i></a>
    &nbsp; &nbsp;
    $button_status
    </center>
    </td>
    </tr>";
    $no++;
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








