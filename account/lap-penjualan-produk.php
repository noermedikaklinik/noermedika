<?php
include "akses.php";
if ($akses["jabatan"] <> "KASIR" and $akses["jabatan"] <> "APOTEKER" and $akses["jabatan"] <> "ASISTEN APOTEKER"){header ("Location:./");}

$day       = date("D");
$tglnow    = date("Y-m-d");
$tglnow1   = date("d/M/Y");
$jamnow    = date("H:i:s");
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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


<body onload="window.print();">
    

<table width="100%" align="center">
<td align="center" style="padding:10px;"><font size="3"><b>SLIP SETORAN KASIR</b><br><font size="2">APOTEK NOER MEDIKA</b></font><br><font size="1"><b><?php echo "$tglnow1 $jamnow"; ?><br><b></b>Kasir : <?php echo "$akses[nama]"; ?></b></font></td>  
</table>

<table id="myTable" style="width:100%;padding:10px;margin-top:0px;">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:5px;"><center>No</center></th>
    <th style="width:25%;padding:5px;">Tanggal / Nota</th>
    <th style="width:20%;padding:5px;">Sub Total</th>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_penjualan where status like '1' and id_user like '$akses[id_user]' and status_setor like '0' and jenis_pembayaran like 'CASH' group by nota order by urut asc");
while ($record=mysqli_fetch_array($query)){
$no++;

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where nota like '$record[nota]' and id_user like '$akses[id_user]'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
$pengunjung11     = mysqli_fetch_object($resultpengunjung);
$total_nota       = $pengunjung11->kunjung;
$total_notarp     = number_format($total_nota,0,",",".");

echo "
<script type='text/javaScript'>
function batalkan_transaksi$no()
{
    tanya = confirm('Anda Yakin Membatalkan Transaksi ?');
    if (tanya == true) return account_list();
    else return false;
}
</script>

<tr>
<td valign='top' style='padding:5px;'><center>$no</center></td>
<td style='padding:5px;'><b>$record[tanggal]</b><br>$record[nota]</td>
<td valign='top' style='padding:5px;'>Rp. $total_notarp</td>
</tr>";
}


$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where id_user like '$akses[id_user]' and jenis_pembayaran like 'CASH' and status_setor like '0' and status like '1'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
$pengunjung1      = mysqli_fetch_object($resultpengunjung);
$cash             = $pengunjung1->kunjung;
$cashrp           = number_format($cash,0,",",".");

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where id_user like '$akses[id_user]' and jenis_pembayaran like 'DEBIT' and status_setor like '0' and status like '1'";
$resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
$pengunjung2      = mysqli_fetch_object($resultpengunjung);
$debit            = $pengunjung2->kunjung;
$debitrp          = number_format($debit,0,",",".");

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where id_user like '$akses[id_user]' and jenis_pembayaran like 'KARTU KREDIT' and status_setor like '0' and status like '1'";
$resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
$pengunjung3      = mysqli_fetch_object($resultpengunjung);
$kartukredit      = $pengunjung3->kunjung;
$kartukreditrp    = number_format($kartukredit,0,",",".");
?>
</table>

<div><hr style="border:2px solid #d1d1d1;"></div>

<table width="100%" align="center" style="padding:10px;margin-top:20px;">
<td align="right" style="width:70%;font-weight:bold;">Total Tunai / Cash :</td>
<td align="left" style="width:30%;padding:5px;font-weight:bold;"> &nbsp; Rp. <?php echo "$cashrp"; ?></td></tr>
<td align="right" style="width:70%;font-weight:bold;">Total Kartu Debit :</td>
<td align="left" style="width:30%;padding:5px;font-weight:bold;"> &nbsp; Rp. <?php echo "$debitrp"; ?></td></tr>
<td align="right" style="width:70%;font-weight:bold;">Total Kartu Kredit :</td>
<td align="left" style="width:30%;padding:5px;font-weight:bold;"> &nbsp; Rp. <?php echo "$kartukreditrp"; ?></td></tr>
</table>

</body>
