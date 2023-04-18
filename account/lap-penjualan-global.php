<?php
include "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$day       = date("D");
$tglnow    = date("Y-m-d");
$tglnow1   = date("d-M-Y");
$jamnow    = date("H:i:s");

$jenis_pembayaran   = isset($_POST['jenis_pembayaran'])?$_POST['jenis_pembayaran']:"";
$tgl1      = isset($_POST['tgl1'])?$_POST['tgl1']:"";
$tgl2      = isset($_POST['tgl2'])?$_POST['tgl2']:"";

if ($jenis_pembayaran == "" and $tgl1 == "" and $tgl2 == ""){$filter = "where status like '1' group by nota order by urut asc";} 
if ($jenis_pembayaran <> "" and $tgl1 <> "" and $tgl2 <> ""){$filter = "where jenis_pembayaran like '$jenis_pembayaran' and tanggal between '$tgl1' and '$tgl2' and status like '1' group by nota order by urut asc";} 
if ($jenis_pembayaran == "" and $tgl1 <> "" and $tgl2 <> ""){$filter = "where tanggal between '$tgl1' and '$tgl2' and status like '1' group by nota order by urut asc";} 
?>

<div style="height:100px;"></div>


<form name="form" method="post" action="lap-penjualan-global" enctype="multipart/form-data">

<table width="80%" align="center" style="margin-top:0px;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td colspan="3">&nbsp;</td></tr>
<td align="center" colspan="3" style="padding:20px;"><font size="3"><b>LAPORAN PENJUALAN</b><br><font size="2">APOTEK NOER MEDIKA SAMARINDA<br>Jalan Grilya No 02, Samarinda Kaltim </font></td></tr>
<td style="padding:20px;">
<table style="width:95%;margin-top:0px;">
    <td align="left" width="50%" style="font-size:12px;">Jenis Pembayaran<br>
        <select name="jenis_pembayaran" style="width:97%;">
        <option value="" selected>SEMUA JENIS</option>
<?php
$query=mysql_query("SELECT * FROM db_penjualan group by jenis_pembayaran");
while ($pay=mysql_fetch_array($query)){
?>
    <option value="<?php echo "$pay[jenis_pembayaran]"; ?>"><?php echo "$pay[jenis_pembayaran]"; ?></option>
        
<?php } ?>
        </select>
    </td>
    <td align="left" width="40%" style="font-size:12px;">Pilih Periode<br><input type="date" name="tgl1" style="width:45%"> &nbsp; &nbsp; <input type="date" name="tgl2" style="width:45%"></td>
    <td width="10%"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending" style="margin-top:25px;"><i id="icon" class=""></i> Cari</button></form></td>
</table>

<table id="myTable" style="width:95%;padding:10px;margin-top:0px;">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:5px;"><center>No</center></th>
    <th align="center" style="width:20%;padding:5px;">Tanggal / Jam Transaksi</th>
    <th style="width:15%;padding:5px;">No Nota</th>
    <th style="width:15%;padding:5px;">Pembayaran</th>
    <th style="width:25%;padding:5px;">Kasir</th>
    <th style="width:15%;padding:5px;">Nominal</th>
  </tr>

<?php
$query=mysql_query("SELECT * FROM db_penjualan $filter");
while ($record=mysql_fetch_array($query)){
$no++;

$result1   = mysqli_query($link, "SELECT * FROM db_user where id_user like '$record[id_user]'");
$staff     = mysqli_fetch_assoc($result1);

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where nota like '$record[nota]'";
$resultpengunjung = mysql_query($sqlpengunjung);
$pengunjung3      = mysql_fetch_object($resultpengunjung);
$total_penjualan  = $pengunjung3->kunjung;
$total_penjualanrp= number_format($total_penjualan,0,",",".");

echo "
<tr>
<td style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'><center>$no</center></td>
<td style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[tanggal] - $record[jam]</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[nota]</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[jenis_pembayaran]</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[id_user] / $staff[username]</td>
<td align='left' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>Rp. $total_penjualanrp</td>
</tr>";
}
?>
</table>
<div style="height:50px;"></div>
</td></table>
<div style="height:50px;"></div>


















