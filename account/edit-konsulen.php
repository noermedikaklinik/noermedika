<?php
include "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
if(isset($_GET['id_user'])){
    $id_konsulen   = $_GET['id_user'];
}else{
    header("Location:konsulen-list");
}
include "mainhead.php";
$result1   = mysqli_query($koneksi, "SELECT * FROM db_konsulen where id_user = '$id_konsulen'");
$staff     = mysqli_fetch_assoc($result1);
?>



<div style="height:110px;"></div>
<form name="login" method="post" action="action/edit-konsulen" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="edit-konsulen">
    <input type="hidden" name="id_user" value="<?php echo "$id_konsulen";?>">

<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td>
<table width="95%" align="center">
<td colspan="2" height="40">&nbsp;</td></tr> 
<td width="100%" style="padding:10px;"><a href="konsulen-list" tooltip="Kembali ke data konsulen" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Update Data Konsulen</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Data Informasi Kosulen</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">Konsulen ID 
<br><input type="text" value="<?php echo "$id_user";?>" autocomplete="off" disabled></td> 
<td style="width:50%;padding:10px;">Username
<br><input type="text" value="<?php echo "$staff[id_user]";?>" autocomplete="off" disabled></td></tr>
</table>

<table width="95%" align="center">
<td style="width:33%;padding:10px;">Nama
<br><input type="text" value="<?php echo "$staff[nama]";?>" autocomplete="off" disabled></td> 
<td style="width:33%;padding:10px;">Alamat (*)
<br><input type="text" name="alamat" value="<?php echo "$staff[alamat]";?>" autocomplete="off"></td>
<td style="width:33%;padding:10px;">Email
<br><input type="email" name="email" value="<?php echo "$staff[email]";?>" autocomplete="off" required></td></tr>
<td style="width:33%;padding:10px;">No Handphone
<br><input type="number" name="hp" value="<?php echo "$staff[hp]";?>" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">Jenis Kelamin
<br><select name="jenis_kelamin" autocomplete="off" required>
    <option value="<?php echo "$staff[jenis_kelamin]";?>"><?php echo "$staff[jenis_kelamin]";?></option>
    <option value=""></option>
    <option value="LAKI LAKI">LAKI LAKI</option>
    <option value="PEREMPUAN">PEREMPUAN</option>
    </select>
</td>
<td style="width:33%;padding:10px;">No Rekening Bank
<br><input type="text" name="bank" value="<?php echo "$staff[bank]";?>" autocomplete="off" required></td></tr>
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td colspan="3">&nbsp;</td></tr>
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Update</button></td></tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>