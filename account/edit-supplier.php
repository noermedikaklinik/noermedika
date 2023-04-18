<?php
require_once "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$id_user   = $_GET['id_user'];
$result1   = mysqli_query($koneksi, "SELECT * FROM db_supplier where id_user like '$id_user'");
$staff     = mysqli_fetch_assoc($result1);
?>

<script>
$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Updating...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Update');

}, 10000);
});
});
</script>



<form name="login" method="post" action="save-data" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="edit-supplier">
    <input type="hidden" name="id_user" value="<?php echo "$id_user";?>">

<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td>
<table width="95%" align="center">
<td colspan="2" height="40">&nbsp;</td></tr> 
<td width="100%" style="padding:10px;"><a href="supplier-list" tooltip="Kembali ke data konsulen" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Update Data Supplier</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Data Informasi Supplier</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">Supplier ID
<br><input type="text" value="<?php echo "$id_user";?>" autocomplete="off" disabled></td> 

<td style="width:50%;padding:10px;">Username
<br><input type="text" value="<?php echo "$staff[id_user]";?>" autocomplete="off" disabled></td></tr>
</table>

<table width="95%" align="center">
<td style="width:33%;padding:10px;">Nama Perusahaan
<br><input type="text" value="<?php echo "$staff[nama]";?>" autocomplete="off" disabled></td> 
<td style="width:33%;padding:10px;">Alamat Perusahaan
<br><input type="text" name="alamat" value="<?php echo "$staff[alamat]";?>" autocomplete="off"></td>
<td style="width:33%;padding:10px;">Email
<br><input type="email" name="email" value="<?php echo "$staff[email]";?>" autocomplete="off"></td></tr>
<td colspan="3">
    <table  width="100%">
    <td style="width:30%;padding:10px;">Kontak Person
    <br><input type="text" name="nama_kontak" value="<?php echo "$staff[nama_kontak]";?>" autocomplete="off" required></td>
    <td style="width:20%;padding:10px;">No Handphone
    <br><input type="number" name="hp" value="<?php echo "$staff[hp]";?>" autocomplete="off" required></td> 
    <td style="width:25%;padding:10px;">Jenis Kelamin
    <br><select name="jenis_kelamin" autocomplete="off" required>
    <option value="<?php echo "$staff[jenis_kelamin]";?>"><?php echo "$staff[jenis_kelamin]";?></option>
    <option value=""></option>
    <option value="LAKI LAKI">LAKI LAKI</option>
    <option value="PEREMPUAN">PEREMPUAN</option>
    </select></td>
<td style="width:25%;padding:10px;">No Rekening Bank
<br><input type="text" name="bank" value="<?php echo "$staff[bank]";?>" autocomplete="off" required></td></tr>     
    </table>
</td></tr>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td colspan="3">&nbsp;</td></tr>
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Update</button></td></tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>

















