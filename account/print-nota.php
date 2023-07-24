<?php
include "akses.php";

$nota      = $_GET['nota'];
$result1   = mysqli_query($koneksi, "SELECT * FROM db_pembayaran where nota like '$nota' and status like '1' and id_user like '$id_user'");
$trx       = mysqli_fetch_assoc($result1);

$cash_terimarp    = number_format($trx["cash_terima"],0,",",".");
$cash_returnrp    = number_format($trx["cash_return"],0,",",".");

$day       = date("D");
$tglnow    = date("d/M/Y");
$jamnow    = date("H:i:s");
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Apotek Noer Medika</title>
        <link rel="shortcut icon" href="../assets/jp-favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../link/mystyle.css" />
        <script type="text/javascript">$(window).load(function() { $("#loading").fadeOut("slow"); })</script>
        <script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
@media screen and (min-width: 279px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:80px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

@media screen and (min-width: 479px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:120px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

@media screen and (min-width: 679px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:80px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

@media screen and (min-width: 1280px) 
{
*{margin:0px auto; /*supaya layer otomatis mengisi dan ke tengah*/}
#wrapper1{width:100%;position:relative;}
#header1{width:100%;position:fixed;height:80px;z-index:1000;}
#header1 a.title{color:#f0f0f0; font-weight:bold; text-decoration:none; font-size:30px; line-height:60px;padding:0px 20px;}
}

body{font-family:verdana, sans-serif;font-size:10px; color:#ggg;background:#ffffff;}
</style>

<div style="height:10px;"></div>

<body onload="window.print();">
    
<table width="80%" align="center">
<td style="width:100%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="100%" align="center">
<td align="center" style="padding:10px;"><font size="3"><b>APOTEK<br>NOER MEDIKA</b></font><br><font size="1">Jalan Grilya No 102, Samarinda<br>Tlp 0541-7811722<br><br><?php echo "$tglnow $jamnow"; ?><br><b>Bukti Pembayaran</b><br>Nota No. <?php echo "$nota"; ?></b><br>Kasir : Kasir<br><br>Semoga Lekas Sembuh</font><hr style="border:1px solid grey;"></td>  
</table>

<table style="width:100%;padding:10px;margin-top:-20px;">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <td style="width:85%;padding:5px;font-weight:bold;">Items</td>
    <td style="width:10%;padding:5px;font-weight:bold;"><center>Qty</center></td>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_penjualan where nota = '$nota' order by no desc") or die(mysqli_error($koneksi));
$no = 0;
while ($record=mysqli_fetch_array($query)){
$no++;

$sub_total_itemrp    = number_format($record["sub_total"],0,",",".");

echo "
<tr>
<td>$record[item]</td>
<td valign='top' align='center'>$record[qty]</td>
</tr>";
}
?>
<td colspan="4" align="right"><hr style="border:1px solid grey;"></td></tr>
</table>

<?php
$sqlpengunjung    = "select sum(sub_total) kunjung from db_penjualan where nota = '$nota'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung) or die(mysqli_error($koneksi));
$pengunjung1      = mysqli_fetch_object($resultpengunjung);
$grand_total      = $pengunjung1->kunjung;
$grand_totalrp    = number_format($grand_total,0,",",".");
?>
<table width="100%" align="center" style="padding:10px;">
<tr>
    <td align="right" style="width:80%;font-weight:bold;">Grand Total</td>
    <td> : </td>
    <td class="text-right"> Rp. <?php echo "$grand_totalrp"; ?></td>
  </tr>
  <tr>
    <td align="right" style="width:80%;font-weight:bold;">Pembayaran</td>
    <td> : </td>
    <td class="text-right"> Rp. <?php echo "$cash_terimarp"; ?></td>
  </tr>
  <tr>
    <td align="right" style="width:80%;font-weight:bold;">Kembali</td>
    <td> : </td>
    <td class="text-right"> Rp. <?php echo "$cash_returnrp"; ?></td>
  </tr>

<td colspan="3" align="right"><hr style="border:1px solid grey;"></td></tr>
<td colspan="3" align="center" style="font-size:8px;"><i>Barang yang telah dibeli tidak dapat dikembalikan</i></td></tr>
</table>

<div style="height:25px;"></div>

</td>
</table>

</body>

<script language="javascript" type="text/javascript">
<!--
window.setTimeout('window.location="kasir"',2000);
// -->
</script>