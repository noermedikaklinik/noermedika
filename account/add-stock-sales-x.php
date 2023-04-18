<?php
include "mainhead.php";

if ($akses[jabatan] <> "ADMIN"){header ("Location:index?message=You Have No Access, Please Contact Your Administrator");}

$id_user   = $_GET['id_user'];
$result1   = mysqli_query($link, "SELECT * FROM db_sales where id_user like '$id_user'");
$sales     = mysqli_fetch_assoc($result1);

$code = mt_rand(100000,999999);
?>

<script>
$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Submitting...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Submit');

}, 10000);
});
});
</script>


<form name="login" method="post" action="save-data" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="add-stock-sales">
    <input type="hidden" name="id_sales" value="<?php echo "$id_user"; ?>">

<div style="height:110px;"></div>

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

<table width="60%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
    <td>
<table width="95%" align="center">
<td height="40">&nbsp;</td></tr>  
<td width="100%" style="padding:10px;"><a href="sales-list" tooltip="Kembali ke data sales" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Stock Sales</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td colspan="4" style="padding:10px;font-size:16px;">Sales
<br><b>ID <?php echo "$id_user"; ?></b>
<br><b><?php echo "$sales[nama]"; ?></b><hr></td></tr> 
<td style="width:25%;padding:10px;">No Transaksi
<br><input type="text" name="nota" value="<?php echo "SS-$code"; ?>" autocomplete="off" required></td> 
<td style="width:25%;padding:10px;">Tanggal Transaksi
<br><input type="date" name="tanggal" autocomplete="off" required></td></tr>
<td style="width:25%;padding:10px;">Pilih Produk
<br><select name="id_produk" required>
    <option value=""></option>
<?php
$query=mysql_query("SELECT * FROM db_produk");
while ($record=mysql_fetch_array($query)){
?>
     <option value="<?php echo "$record[id_produk]"; ?>"><?php echo "$record[nama]"; ?></option>

<?php } ?>

  </select></td> 
<td style="width:25%;padding:10px;">Jumlah Stock Keluar
<br><input type="number" name="jumlah" autocomplete="off" style="width:100%" placeholder="satuan cover pack" required></td> 
</table>


<div style="height:25px;"></div>

<table width="95%" align="center">
<td colspan="3">&nbsp;</td></tr>
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Submit</button></td></tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>


















