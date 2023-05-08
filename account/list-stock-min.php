<?php
include "akses.php";
if ($akses['hak_akses'] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";
?>


<div style="height:110px;"></div>

<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2"><font size="4" color="#5b8ff5"><b>Data Persediaan Barang Minimum</b></font></td></tr>
    <td colspan="3" height="40">&nbsp;</td></tr>
    <td align="left" width="5%"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="pencarian data barang..." autofocus></td>
    <td align="right" width="5%">&nbsp;</td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:10%;padding:10px;"><center>Foto</center></th>
    <th style="width:25%;padding:10px;">Kode Barang</th>
    <th style="width:25%;padding:10px;">Nama Barang</th>
    <th style="width:10%;padding:10px;">Persediaan</th>
    <th style="width:7%;padding:10px;"><center>Action</center></th>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_produk");
$no = 1;
while ($record=mysqli_fetch_array($query)){

$result1   = mysqli_query($koneksi, "SELECT * FROM db_supplier where id_user like '$record[id_supplier]'");
$sup       = mysqli_fetch_assoc($result1);

$sqlpengunjung    = "select sum(jumlah) kunjung from db_stock_produk where id_produk like '$record[id_produk]'";
$resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
$pengunjung1      = mysqli_fetch_object($resultpengunjung);
$jml_stock        = $pengunjung1->kunjung;
$jml_stockrp      = number_format($jml_stock,0,",",".");

$sqlpengunjung    = "select sum(qty) kunjung from db_penjualan where id_produk like '$record[id_produk]' and status like '1'";
$resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
$pengunjung2      = mysqli_fetch_object($resultpengunjung);
$jml_terjual      = $pengunjung2->kunjung;
$jml_terjualrp    = number_format($jml_terjual,0,",",".");

$sisa_stock       = $jml_stock - $jml_terjual;
$sisa_stockrp     = number_format($sisa_stock,0,",",".");


if ($sisa_stock <= $record['min_stok'])
{
echo "
<script type='text/javaScript'>
function list_po$no()          {window.location = 'save-data?id_produk=$record[id_produk]&jenis2=list-po'}
</script>

<tr>
<td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
<td style='border:1px solid #d1d1d1;padding:10px;'><center><img src='produk-image/$record[foto]' style='width:65px;height:auto;border-radius:10px;'></center></td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$record[id_produk]<br>Supplier : $sup[nama]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$record[nama_produk]<br>$record[kategori_produk]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$sisa_stockrp $record[satuan_produk]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'><center><a tooltip='Tambahkan barang ke List P.O' flow='left' ><i class='fa fa-edit' style='color:orange;font-size:18px;' onclick='return list_po$no();'></i></a></center>
</td>
</tr>";
$no++;

}
else { echo ""; }
}
?>
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
    td = tr[i].getElementsByTagName("td")[3];
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








