<?php
include "akses.php";

$day       = date("D");
$tglnow    = date("Y-m-d");
$tglnow1   = date("d-M-Y");
$jamnow    = date("H:i:s");

$id_user = $akses['id_user'];
$tgl1      = isset($_POST['tgl1'])?$_POST['tgl1']:"";

$result1   = mysqli_query($koneksi, "SELECT * FROM db_user where id_user like '$id_user'");
$user      = mysqli_fetch_array($result1);

if ($tgl1 == ""){$filter = "where id_user like '$id_user'";} 
if ($tgl1 <> ""){$filter = "where id_user like '$id_user' and tanggal like '$tgl1' and status like '1' and status_setor like '0' group by nota order by no asc";} 
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

<?php
$alert   = isset($_GET['alert'])?$_GET['alert']:"";
$message = isset($_GET['message'])?$_GET['message']:"";
if ($message <> "")
{
?>
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    });    
</script>

<div class="container" style="width:100%;">
    <div class="<?php echo "$alert"; ?>" role="alert">
    <center><?php echo "$message"; ?></center>
    </div>
</div>

<?php 
} 
?>

<form name="form" method="post" action="lap-kasir" enctype="multipart/form-data">

<table width="95%" align="center" style="margin-top:30px;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td colspan="3" align="center" style="padding:20px;"><font size="3"><b>LAPORAN SETORAN KASIR</b><br><font size="2">APOTEK NOER MEDIKA</b></font><br><br><font size="2">Nama : <?php echo "$user[nama]"; ?><br>Periode : <?php echo "$tgl1"; ?></font></td></tr>
<td style="padding:20px;">
<table style="width:100%;margin-top:20px;">
    <td align="left" width="60%" style="font-size:12px;">Pilih Kasir<br>
        <select name="id_user" style="width:97%;">
        <option value=""></option>
<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_user where jabatan like 'KASIR' or jabatan like 'APOTEKER' or jabatan like 'ASISTEN APOTEKER'");
while ($user=mysqli_fetch_array($query)){
?>
    <option value="<?php echo "$user[id_user]"; ?>"><?php echo "$user[nama]"; ?></option>
        
<?php } ?>
        </select>
    </td>
    <td align="left" width="30%" style="font-size:12px;">Pilih Periode<br><input type="date" name="tgl1" style="width:90%"></td>
    <td width="10%"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending" style="margin-top:15px;"><i id="icon" class=""></i> Cari</button></form></td>
</table>

<table id="myTable" style="width:100%;padding:10px;margin-top:0px;">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:5px;"><center>No</center></th>
    <th style="width:25%;padding:5px;">Tanggal</th>
    <th style="width:25%;padding:5px;">No Nota</th>
    <th style="width:20%;padding:5px;">Total</th>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_penjualan $filter");
$no = 0;
while ($record=mysqli_fetch_array($query)){
$no++;

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where nota like '$record[nota]'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
$pengunjung11     = mysqli_fetch_object($resultpengunjung);
$total_nota       = $pengunjung11->kunjung;
$total_notarp     = number_format($total_nota,0,",",".");

$sqlpengunjung    = "select sum(ppn) kunjung from db_penjualan where nota like '$record[nota]'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
$pengunjung12     = mysqli_fetch_object($resultpengunjung);
$total_ppn        = $pengunjung12->kunjung;
$total_ppnrp      = number_format($total_ppn,0,",",".");

$sqlpengunjung    = "select sum(sub_total_ppn) kunjung from db_penjualan where nota like '$record[nota]'";
$resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
$pengunjung13     = mysqli_fetch_object($resultpengunjung);
$sub_total_ppn    = $pengunjung13->kunjung;
$sub_total_ppnrp  = number_format($sub_total_ppn,0,",",".");

echo "
<tr>
<td valign='top' style='padding:5px;border:2px solid #d1d1d1;'><center>$no</center></td>
<td style='padding:5px;border:2px solid #d1d1d1;'>$record[tanggal]</td>
<td style='padding:5px;border:2px solid #d1d1d1;'>$record[nota]</td>
<td valign='top' style='padding:5px;border:2px solid #d1d1d1;'>Rp. $total_notarp</td>
</tr>";
}


$sqlpengunjung    = "select sum(sub_total) kunjung from db_penjualan where id_user like '$id_user' and tanggal like '$tgl1' and jenis_pembayaran like 'CASH' and status_setor like '0'";
$resultpengunjung = mysqli_query($koneksi,$sqlpengunjung) or die(mysqli_error($koneksi));
$pengunjung1      = mysqli_fetch_object($resultpengunjung);
$total_cash   = $pengunjung1->kunjung;
$total_cashrp = number_format($total_cash,0,",",".");

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where id_user like '$id_user' and tanggal like '$tgl1' and jenis_pembayaran like 'DEBIT' and status_setor like '0'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung) or die(mysqli_error($koneksi));
$pengunjung2      = mysqli_fetch_object($resultpengunjung);
$total_debit      = $pengunjung2->kunjung;
$total_debitrp    = number_format($total_debit,0,",",".");

$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where id_user like '$id_user' and tanggal like '$tgl1' and jenis_pembayaran like 'KARTU KREDIT' and status_setor like '0'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung) or die(mysqli_error($koneksi));
$pengunjung3      = mysqli_fetch_object($resultpengunjung);
$total_kredit     = $pengunjung3->kunjung;
$total_kreditrp   = number_format($total_kredit,0,",",".");
?>
</table>

<table width="79%" align="center" style="padding:10px;margin-top:20px;">
<td align="right" style="font-weight:bold;font-size:12px;padding:10px;">Cash / Tunai : Rp. <?php echo "$total_cashrp"; ?></td></tr>
<td align="right" style="font-weight:bold;font-size:12px;padding:10px;">Kartu Debit : Rp. <?php echo "$total_debitrp"; ?></td></tr>
<td align="right" style="font-weight:bold;font-size:12px;padding:10px;">Kartu Kredit : Rp. <?php echo "$total_kreditrp"; ?></td></tr>
</table>

<form name="formsetor" method="post" action="save-data" enctype="multipart/form-data">
<input type="hidden" name="jenis" value="rekonsiliasi-kasir">
<input type="hidden" name="status_setor" value="1">
<input type="hidden" name="id_user" value="<?php echo "$id_user";?>">
<input type="hidden" name="tanggal" value="<?php echo "$tgl1";?>">
    
<table width="100%" align="center" style="padding:10px;margin-top:20px;">
<td align="right"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending" style="margin-top:15px;"><i id="icon" class=""></i> Confirmed</button></form></td>
</table>

</td></table>
<div style="height:50px;"></div>


















