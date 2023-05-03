<?php
require "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$id_user = $_GET['id_user'];
$result1   = mysqli_query($koneksi, "SELECT * FROM db_user where id_user like '$id_user'");
$staff   = mysqli_fetch_assoc($result1);
?>


<form name="login" method="post" action="action/edit-account" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="edit-user-account">
    <input type="hidden" name="id_user" value="<?php echo "$id_user";?>">
    <input type="hidden" name="image" value="<?php echo "$staff[foto]";?>">

<table class="table-main">
<td>
<table width="95%" align="center">
<td colspan="2" height="40">&nbsp;</td></tr> 
<td width="100%" style="padding:10px;"><a href="account-list" tooltip="Kembali ke data akun karyawan" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Update Akun Karyawan</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Foto</b></font></td></tr>
<td style="padding:10px;"><img src="staff-image/<?php echo "$staff[foto]";?>" style="width:10%;height:auto;border-radius:5px;margin-top:20px;"></td></tr>
<td style="padding:10px;"><input type="file" name="doc1"></td></tr>
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Login</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">ID Karyawan
<br><input type="text" value="<?php echo "$id_user";?>" autocomplete="off" disabled></td> 

<td style="width:50%;padding:10px;">Username
<br><input type="text" name="username" value="<?php echo "$staff[username]";?>" autocomplete="off" required></td></tr>
</table>


<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Karyawan</b></font></td>
</table>

<table width="95%" align="center">
<td colspan="2" style="width:50%;padding:10px;">Nama
<br><input type="text" name="nama" value="<?php echo "$staff[nama]";?>" autocomplete="off" required></td> 


<td colspan="1" style="width:50%;padding:10px;">
    Posisi<br>
    <select name="jabatan" id="kota" required>
        <option value="<?php echo "$staff[jabatan]";?>"><?php echo "$staff[jabatan]";?></option>
        <option value="APOTEKER">APOTEKER</option>
        <option value="ASISTEN APOTEKER">ASISTEN APOTEKER</option>
        <option value="PENDAFTARAN">PENDAFTARAN</option>
        <option value="KEUANGAN">KEUANGAN</option>
        <option value="DOKTER">DOKTER</option>
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
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Update</button></td></tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>

















