<?php
include "mainhead.php";

if ($akses['hak_akses'] <> "ADMIN"){header ("Location:index?message=You Have No Access, Please Contact Your Administrator");}

$id_user   = $_GET['id_user'];
$result1   = mysqli_query($link, "SELECT * FROM db_sales where id_user like '$id_user'");
$sales     = mysqli_fetch_assoc($result1);

$id_produk = $_POST['id_produk'];
$tgl1      = $_POST['tgl1'];
$tgl2      = $_POST['tgl2'];

if ($id_produk == "" and $tgl1 == "" and $tgl2 == ""){$filter = "where id_sales like '$id_user' and jumlah <> '0' order by no asc";$filter_produk = "";$produk_cari = "Semua Produk";}
if ($id_produk == "" and $tgl1 <> "" and $tgl2 <> ""){$filter = "where tanggal between '$tgl1' and '$tgl2' and id_sales like '$id_user' and jumlah <> '0' order by no asc";$produk_cari = "Semua Produk";} 
if ($id_produk <> "" and $tgl1 == "" and $tgl2 == ""){$filter = "where id_produk like '$id_produk' and id_sales like '$id_user' and jumlah <> '0' order by no asc";$filter_produk = "and id_produk like '$id_produk'";$produk_cari = "$id_produk";} 
if ($id_produk <> "" and $tgl1 <> "" and $tgl2 == ""){$filter = "where id_produk like '$id_produk' and tanggal like '$tgl1' and id_sales like '$id_user' and jumlah <> '0' order by no asc";$filter_produk = "and id_produk like '$id_produk'";$produk_cari = "$id_produk";} 
if ($id_produk <> "" and $tgl1 <> "" and $tgl2 <> ""){$filter = "where id_produk like '$id_produk' and tanggal between '$tgl1' and '$tgl2' and id_sales like '$id_user' and jumlah <> '0' order by no asc";$filter_produk = "and id_produk like '$id_produk'";$produk_cari = "$id_produk";} 

$sqlpengunjung    = "select sum(total) kunjung from db_order $filter";
$resultpengunjung = mysql_query($sqlpengunjung);
$pengunjung1      = mysql_fetch_object($resultpengunjung);
$total_sales      = $pengunjung1->kunjung;
$total_salesrp    = number_format($total_sales,0,",",".");
?>

<style>
  input[type=text] {
  width: 50%;
  height:50px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  background-color: white;
  background-image: url('../assets/searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding-left: 50px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
  
}
</style>

<div style="height:110px;"></div>

<script>
$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Processing...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Cari');

}, 10000);
});
});
</script>

<?php
$alert   = $_GET['alert'];
$message = $_GET['message'];
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

<form name="form" method="post" action="histori-penjualan-sales?id_user=<?php echo "$id_user"; ?>" enctype="multipart/form-data">
    
<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td style="padding:20px;">
<table style="width:95%;margin-top:20px;">
    <td colspan="4" style="padding:10px;"><a href="direct-sales-report" tooltip="Kembali ke data report direct sales" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Riwayat Penjualan Sales</b></font></td></tr>
    <td colspan="4" height="40">&nbsp;</td></tr>
    <td colspan="4" style="padding:10px;font-size:16px;">Sales
    <br><b>ID <?php echo "$id_user"; ?></b>
    <br><b><?php echo "$sales[nama]"; ?></b><hr></td></tr> 
    <td colspan="4" style="padding:10px;"><?php include "chart-ds.php"; ?></td></tr>
    <td align="left" width="25%">Pilih Produk<br><select name="id_produk" style="width:97%;">
        <option value="">filter produk</option>
<?php
$query=mysql_query("SELECT * FROM db_order where id_sales like '$id_user' group by id_produk");
while ($produk=mysql_fetch_array($query)){
    
$result1 = mysqli_query($link, "SELECT * FROM db_produk where id_produk like '$produk[id_produk]'");
$produk2  = mysqli_fetch_assoc($result1);
?>
    <option value="<?php echo "$produk2[id_produk]"; ?>"><?php echo "$produk2[nama]"; ?></option>
        
<?php } ?>
        </select>
    </td>
    <td align="left" width="35%">Pilih Periode<br><input type="date" name="tgl1" style="width:45%"> &nbsp; <input type="date" name="tgl2" style="width:45%"></td>
    <td width="15%"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending" style="margin-top:25px;"><i id="icon" class=""></i> Cari</button></form></td>
    <td align="right" width="20%">&nbsp;</td></tr>
</table>


<table style="width:95%;padding:20px;margin-top:20px;">
    <td style="font-size:14px;">Total Penjualan Periode : <?php echo "$tgl1 s/d $tgl2"; ?><br>Rp. <?php echo "$total_salesrp"; ?></td>
</table>


<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:7%;padding:8px;"><center>Tanggal</center></th>
    <th style="width:10%;padding:10px;">ID Transaksi</th>
    <th style="width:15%;padding:10px;">Nama Produk</th>
    <th style="width:7%;padding:10px;"><center>Qty</center></th>
    <th style="width:10%;padding:10px;">Nominal</th>
  </tr>

<?php
$query=mysql_query("SELECT * FROM db_order $filter");
while ($record=mysql_fetch_array($query)){
$no++;

$result1 = mysqli_query($link, "SELECT * FROM db_produk where id_produk like '$record[id_produk]'");
$produk3 = mysqli_fetch_assoc($result1);

$totalrp  = number_format($record[total],0,",",".");

echo "
<tr>
<td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
<td style='border:1px solid #d1d1d1;padding:10px;'><center>$record[tanggal]</center></td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$record[nota]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$produk3[nama]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'><center>$record[jumlah]</center></td>
<td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $totalrp</td>
</tr>";
}
?>
</table>

<div style="height:35px;"></div>
    
</td>
</table>

<div style="height:45px;"></div>








