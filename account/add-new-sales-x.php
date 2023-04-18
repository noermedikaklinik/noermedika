<?php
include "mainhead.php";

if ($akses[jabatan] <> "ADMIN"){header ("Location:index?message=Access Denied");}

$code =  mt_rand(100, 999);
?>

<script>
$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Processing...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Submit');

}, 10000);
});
});
</script>

<form name="login" method="post" action="save-data" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="new-sales">
    <input type="hidden" name="id_user" value="<?php echo "SL-$code";?>">


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

<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td>
<table width="95%" align="center">
<td colspan="2" height="40">&nbsp;</td></tr> 
<td width="100%" style="padding:10px;"><a href="sales-list" tooltip="Kembali ke data sales" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Sales Baru</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="width:50%;padding:10px;"><font size="2"><b>Upload Foto Sales</b></font>
<br><input type="file" name="doc1"></td>
<td style="width:50%;padding:10px;"><font size="2"><b>Upload KTP Sales</b></font>
<br><input type="file" name="doc2"></td></tr>
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Login</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">Sales ID
<br><input type="text" value="<?php echo "SL-$code";?>" autocomplete="off" disabled></td> 

<td style="width:50%;padding:10px;">Username
<br><input type="text" name="username" value="<?php echo "SL-$code";?>" autocomplete="off"></td></tr>
</table>


<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Sales</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:33%;padding:10px;">Nama
<br><input type="text" name="nama" autocomplete="off"></td> 


<td style="width:33%;padding:10px;">Posisi
<br><select name="jabatan" id="kota" required>
    <option value="SALES">SALES</option>
    </select>
</td>

<td style="width:33%;padding:10px;">Team Leader ID
<br><select name="id_tl" id="id_tl" required>
    <option value=""></option>
<?php
$query=mysql_query("SELECT * FROM db_team_leader");
while ($record=mysql_fetch_array($query)){
?>
    <option value="<?php echo "$record[id_user]"; ?>"><?php echo "$record[id_user]"; ?> : <?php echo "$record[nama]"; ?></option>
    
<?php } ?>
    </select>
</td>
</tr>

<td colspan="3" style="padding:10px;">Alamat (*)
<br><input type="text" name="alamat" value="<?php echo "$staff[alamat]";?>" autocomplete="off"></td></tr>

<td style="width:33%;padding:10px;">Email
<br><input type="email" name="email" value="<?php echo "$staff[email]";?>" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">No Handphone
<br><input type="number" name="hp" value="<?php echo "$staff[hp]";?>" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">Jenis Kelamin
<br><select name="jenis_kelamin" autocomplete="off" required>
    <option value="<?php echo "$staff[jenis_kelamin]";?>"><?php echo "$staff[jenis_kelamin]";?></option>
    <option value="LAKI LAKI">LAKI LAKI</option>
    <option value="PEREMPUAN">PEREMPUAN</option>
    </select>
</td></tr>
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

















