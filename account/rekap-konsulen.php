<?php
include "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$day       = date("D");
$tglnow    = date("Y-m-d");
$tglnow1   = date("d-M-Y");
$jamnow    = date("H:i:s");

$tgl1      = isset($_GET['tgl1'])?$_GET['tgl1']:"";
$tgl2      = isset($_GET['tgl2'])?$_GET['tgl2']:"";

$id_user   = $_GET['id_user'];

if ($tgl1 == "" and $tgl2 == ""){$filter = "where id_konsulen like '$id_user' and status like '1' group by nota order by no asc";} 
if ($tgl1 <> "" and $tgl2 <> ""){$filter = "where id_konsulen like '$id_user' and tanggal between '$tgl1' and '$tgl2' and status like '1' group by nota order by no asc";} 
?>

<div style="height:100px;"></div>


<form name="form" method="get" action="rekap-konsulen" enctype="multipart/form-data">
    <input type="hidden" name="id_user" value="<?php echo "$id_user"; ?>">

<table width="80%" align="center" style="margin-top:0px;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td colspan="3">&nbsp;</td></tr>
<td style="padding:20px;">
<table style="width:90%;margin-top:0px;">
    <td colspan="3">&nbsp;</td></tr>
    <td colspan="3"><a href="konsulen-list" tooltip="Kembali ke data konsulen" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="3"><b>Rekapitulasi Fee Konsulen</b><br><font size="2"></b></font></td></tr>
    <td colspan="3" height="50">&nbsp;</td></tr>
    <td align="left" width="40%" style="font-size:12px;">Pilih Periode<br><input type="date" name="tgl1" style="width:45%"> &nbsp; &nbsp; <input type="date" name="tgl2" style="width:45%"></td>
    <td width="10%"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending" style="margin-top:25px;"><i id="icon" class=""></i> Cari</button></form></td>
</table>

<table id="myTable" style="width:90%;padding:10px;margin-top:0px;">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:5px;"><center>No</center></th>
    <th align="center" style="width:20%;padding:5px;">Tanggal</th>
    <th style="width:15%;padding:5px;">No Nota</th>
    <th style="width:15%;padding:5px;">Total Nota</th>
    <th style="width:25%;padding:5px;">Fee</th>
    <th style="width:15%;padding:5px;">Nominal Fee</th>
  </tr>

<?php
$query=mysqli_query($koneksi,"SELECT * FROM db_penjualan $filter");
$no = 1;
$total_fee = 0;
while ($record=mysqli_fetch_array($query)){

$result1   = mysqli_query($link, "SELECT * FROM db_konsulen where id_user like '$record[id_konsulen]'");
$konsulen  = mysqli_fetch_assoc($result1);

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where nota like '$record[nota]'";
$resultpengunjung = mysql_query($sqlpengunjung);
$pengunjung3      = mysql_fetch_object($resultpengunjung);
$total_penjualan  = $pengunjung3->kunjung;
$total_penjualanrp= number_format($total_penjualan,0,",",".");

$nominal_fee   = $total_penjualan * $konsulen[fee]/100;
$nominal_feerp = number_format($nominal_fee,0,",",".");

$total_fee   = $total_fee + $nominal_fee;

echo "
<tr>
<td style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'><center>$no</center></td>
<td style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[tanggal] - $record[jam]</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[nota]</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>Rp. $total_penjualanrp</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$konsulen[fee]%</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>Rp. $nominal_feerp</td>
</tr>";
$no++;
}
$total_feerp = number_format($total_fee,0,",",".");

?>

<td colspan="6" align="right" style="padding:20px;height:50px;font-size:16px;">Total Fee Konsulen : Rp. <?php echo "$total_feerp"; ?></td></tr>
</table>
<div style="height:50px;"></div>
</td></table>
<div style="height:50px;"></div>
