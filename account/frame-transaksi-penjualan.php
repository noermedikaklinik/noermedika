<?php
include "akses.php";
$kode_trx = $_GET['kode_trx'];
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

body{font-family:verdana, sans-serif;font-size:12px; color:#ggg;background:#ffffff;}
.link {background:#eeeceb;height:50px;color:#ggg; -webkit-transition: 0.7s; transition: 0.7s;}
.link:hover {background:#e5c309;height:40px;color:#ggg;}
</style>

<table id="myTable" style="width:100%;padding:10px;margin-top:0px;">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:55%;padding:10px;">Nama Barang / Items</th>
    <th style="width:15%;padding:10px;">Harga Satuan</th>
    <th style="width:10%;padding:10px;"><center>Qty</center></th>
    <th style="width:15%;padding:10px;">Sub Total</th>
    <th style="width:5%;padding:10px;"><center>Batal</center></th>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_penjualan where kode_trx like '$kode_trx' and status like '0' and id_user like '$akses[id_user]' order by no desc");
$no = 0;
while ($record=mysqli_fetch_array($query)){
$no++;

$sub_total_itemrp    = number_format($record["sub_total_jual"],0,",",".");
$harga_jual_itemrp   = number_format($record["harga_jual"],0,",",".");

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
<td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$record[item]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $harga_jual_itemrp</td>
<td align='center' style='border:1px solid #d1d1d1;padding:10px;'>$record[qty]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $sub_total_itemrp</td>
<td align='center' style='border:1px solid #d1d1d1;padding:10px;'><a href='action/del-trx-item?no=$record[no]&kode_trx=$kode_trx' tooltip='Batalkan Transaksi Item' flow='left' ><i class='fa fa-times' style='color:red;font-size:18px;' onclick='return batalkan_transaksi$no();'></i></a></td>
</tr>";
}
?>
</table>