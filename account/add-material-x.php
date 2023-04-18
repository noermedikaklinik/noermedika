<?php
include "mainhead.php";

if ($akses[jabatan] <> "ADMIN"){header ("Location:index?message=You Have No Access, Please Contact Your Administrator");}
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
    <input type="hidden" name="jenis" value="add-material-masuk">

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
<td width="100%" style="padding:10px;"><a href="mutasi-stock-material" tooltip="Kembali ke data stock material" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Stock Bahan Baku Masuk</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="width:33%;padding:10px;">No Transaksi Bahan Baku Masuk
<br><input type="text" name="nota" value="<?php echo "MM-$code"; ?>" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">Tanggal Bahan Baku Masuk
<br><input type="date" name="tanggal" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">Jumlah Bahan Baku Masuk
<br><input type="number" name="jumlah" autocomplete="off" style="width:90%" placeholder="satuan dalam kilogram" required> KG</td> 
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


















