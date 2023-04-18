<?php
include "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){echo "<br><br><br><br>Akses tidak diijinkan";}

$day       = date("D");
$tglnow    = date("Y-m-d");
$tglnow1   = date("d-M-Y");
$jamnow    = date("H:i:s");

$id_user   = isset($_POST['id_user'])?$_POST['id_user']:$akses['id_user'];
$tgl1      = isset($_POST['tgl1'])?$_POST['tgl1']:"";

$result1   = mysqli_query($koneksi, "SELECT * FROM db_user where id_user like '$id_user'");
$user      = mysqli_fetch_assoc($result1);

if ($tgl1 == ""){$filter = "where id_user like '$id_user'";} 
if ($tgl1 <> ""){$filter = "where id_user like '$id_user' and tanggal like '$tgl1'  order by no asc";} 
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

body{font-family:verdana, sans-serif;font-size:10px; color:#ggg;background:#dadada;}

input[type=text],input[type=password],select,input[type=number],input[type=file],input[type=email],input[type=date],input[type=time],textarea
{
    font-size: 14px;
    width: 100%;
    padding: 15px 10px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    -webkit-transition: 0.5s;
    transition: 0.5s;
    outline: none;
    background-size: 30px;
    background-position: 5px 5px;
    background-repeat: no-repeat;
    padding-left: 10px;
    border-radius: 5px;
}

input[type=text]:focus {background:#e4dab2;border: 2px solid #f0ca34;}
input[type=email]:focus {background:#e4dab2;border: 2px solid #f0ca34;}
input[type=date]:focus {background:#e4dab2;border: 2px solid #f0ca34;}
input[type=time]:focus {background:#e4dab2;border: 2px solid #f0ca34;}
select:focus {background:#e4dab2;border: 2px solid #f0ca34;}
input[type=number]:focus {background:#e4dab2;border: 2px solid #f0ca34;}

input[type=submit],input[type=reset]{
    font-size: 14px;
    background: #009973;
    color: white;
    border: white 3px solid;
    border-radius: 5px;
    padding: 12px 20px;
    cursor:pointer;
    margin-top: 10px;
    width:125px;    
    -webkit-transition: 0.5s;
    transition: 0.5s;
}

input[type=submit]:hover,input[type=reset]:hover{
    opacity:0.9;width:150px;
}

input[type=reset]{
    background:  #999999;
}

button{
    font-size: 14px;
    font-family:arial;
    background: #8fa93a;
    color: white;
    border: white 0px solid;
    border-radius: 10px;
    padding: 12px 20px;
    cursor:pointer;
    width:200px;   
    height:50px;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}
button:hover{
    background: #75960b;
}
</style>

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

<form name="form" method="post" action="lap-absensi" enctype="multipart/form-data">

<table width="95%" align="center" style="margin-top:30px;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td colspan="3" align="center" style="padding:20px;"><font size="3"><b>LAPORAN ABSENSI</b><br><font size="2">APOTEK NOER MEDIKA</b></font><br><br><font size="2">Nama : <?php echo "$user[nama]"; ?><br>Periode : <?php echo "$tgl1"; ?></font></td></tr>
<td style="padding:20px;">
<table style="width:100%;margin-top:20px;">
    <td align="left" width="60%" style="font-size:12px;">Pilih Karyawan<br>
        <select name="id_user" style="width:97%;">
        <option value=""></option>
<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_user");
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
    <th align="center" style="width:10%;padding:5px;">Foto</th>
    <th style="width:35%;padding:5px;">Tanggal & Jam</th>
    <th style="width:15%;padding:5px;">Check</th>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_absensi $filter");
$no = 0;
while ($record=mysqli_fetch_array($query)){
$no++;

echo "
<tr>
<td style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'><center>$no</center></td>
<td align='center' valign='top' style='padding:5px;border:2px solid #d1d1d1;'><img src='foto-absensi/$record[foto]' style='width:100%;height:auto;border-radius:10px;'></td>
<td style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[tanggal] - $record[jam]</td>
<td align='center' style='padding:5px;border:2px solid #d1d1d1;font-size:12px;'>$record[status]</td>

</tr>";
}
?>
</table>
<div style="height:50px;"></div>
</td></table>
<div style="height:50px;"></div>


















