<?php
include "akses.php";
if ($akses["hak_akses"] <> "ADMIN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$code = mt_rand(100,999);
?>


<div style="height:110px;"></div>


<form name="login" method="post" action="action/add-supplier" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="new-supplier">
    <input type="hidden" name="id_user" value="<?php echo "SP-$code";?>">
    <input type="hidden" name="username" value="<?php echo "SP-$code";?>">

<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
    <td>
<table width="95%" align="center">
<td height="40">&nbsp;</td></tr>  
<td width="100%" style="padding:10px;"><a href="supplier-list" tooltip="Kembali ke data supplier" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:22px;"></i></a> &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Data Supplier</b></font></td>  
</table>

<div style="height:25px;"></div>


<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Data Informasi Supplier</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">Suppler ID
<br><input type="text" value="<?php echo "SP-$code";?>" autocomplete="off" disabled></td>
<td style="width:50%;padding:10px;">Username
<br><input type="text" value="<?php echo "SP-$code";?>" maxLength="6" autocomplete="off" disabled></td></tr>
</table>

<table width="95%" align="center">
<td style="width:33%;padding:10px;">Nama Perusahaan
<br><input type="text" name="nama" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">Alamat Perusahaan
<br><input type="text" name="alamat" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">Email
<br><input type="email" name="email" autocomplete="off"></td></tr>
<td colspan="3">
    <table  width="100%">
    <td style="width:30%;padding:10px;">Kontak Person
    <br><input type="text" name="nama_kontak" autocomplete="off" required></td>
    <td style="width:20%;padding:10px;">No Handphone
    <br><input type="number" name="hp" autocomplete="off" required></td> 
    <td style="width:25%;padding:10px;">Jenis Kelamin
    <br><select name="jenis_kelamin" autocomplete="off" required>
    <option value=""></option>
    <option value="LAKI LAKI">LAKI LAKI</option>
    <option value="PEREMPUAN">PEREMPUAN</option>
    </select></td>
<td style="width:25%;padding:10px;">No Rekening Bank
<br><input type="text" name="bank" autocomplete="off" required></td></tr>     
    </table>
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


















