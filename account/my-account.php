<?php
include "akses.php";
include "mainhead.php";
?>


<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
    <td>
<table width="95%" align="center">
<td colspan="2" height="40">&nbsp;</td></tr>  
<td width="100%" style="padding:10px;"><font size="4" color="#5b8ff5"><b>Akun Saya</b></font></td></tr>
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Foto</b></font>
<br><img src="staff-image/<?php echo "$akses[foto]";?>" style="width:10%;height:auto;border-radius:5px;"></td></tr>
</table>


<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Login</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">Username<br><input type="text" name="nama" value="<?php echo "$akses[username]";?>" autocomplete="off" disabled></td> 
<td align="center" style="width:50%;padding:10px;"><a href=""><font size="3"><i class="fa fa-lock" onclick="return showDetails('change-password')"> Ubah Password</i></font></a></td></tr>
</table>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Akun</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:33%;padding:10px;">Nama<br><input type="text" name="nama" value="<?php echo "$akses[nama]";?>" autocomplete="off" disabled></td> 
<td style="width:33%;padding:10px;">Alamat<br><input type="text" name="alamat" value="<?php echo "$akses[alamat]";?>" autocomplete="off" disabled></td> 
<td style="width:33%;padding:10px;">Email<br><input type="text" name="email" value="<?php echo "$akses[email]";?>" autocomplete="off" disabled></td></tr>

<td style="width:33%;padding:10px;">Posisi<br><input type="text" name="jabatan" value="<?php echo "$akses[jabatan]";?>" autocomplete="off" disabled></td> 
<td style="width:33%;padding:10px;">No Handphone<br><input type="text" name="hp" value="<?php echo "$akses[hp]";?>" autocomplete="off" ></td> 
<td style="width:33%;padding:10px;">Jenis Kelamin<br><input type="text" name="jenis_kelamin" value="<?php echo "$akses[jenis_kelamin]";?>" autocomplete="off" disabled></td></tr>
</table>


<div style="height:45px;"></div>

<table width="95%" align="center">
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Update</button></td></tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>


<script src="../link/myjs.js"></script>
















