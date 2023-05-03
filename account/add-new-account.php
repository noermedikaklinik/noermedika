<?php
require "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$code =  mt_rand(100, 999);
?>



<form name="login" method="post" action="action/add-account" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="new-account">
    <input type="hidden" name="id_user" value="<?php echo "ST$code";?>">
<table class="table-main">
    <td>
<table width="95%" align="center">
<td height="40">&nbsp;</td></tr>  
<td width="100%" style="padding:10px;"><a href="account-list" tooltip="Kembali ke data karyawan" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Karyawan Baru</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Foto</b></font>
<br><input type="file" name="doc1" required></td></tr>
</tr>
</table>


<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Login</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">ID Karyawan
<br><input type="text" value="<?php echo "ST$code";?>" autocomplete="off" disabled></td>
<td style="width:50%;padding:10px;">Username
<br><input type="text" name="username" placeholder="create your own with 7 digits" value="<?php echo "ST$code";?>" maxLength="6" autocomplete="off" required></td></tr>
</table>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Akun</b></font></td>
</table>

<table width="95%" align="center">
    <tr>
        <td style="width:33%;padding:10px;">Nama
        <br><input type="text" name="nama" autocomplete="off" required></td> 
        <td style="width:33%;padding:10px;">Alamat
        <br><input type="text" name="alamat" autocomplete="off" required></td> 
        <td style="width:33%;padding:10px;">Email
        <br><input type="email" name="email" autocomplete="off" required></td>
    </tr>
    <tr>
        <td style="width:33%;padding:10px;">Posisi
            <br>
            <select name="jabatan" autocomplete="off" required>
                <option value="APOTEKER">APOTEKER</option>
                <option value="ASISTEN APOTEKER">ASISTEN APOTEKER</option>
                <option value="PENDAFTARAN">PENDAFTARAN</option>
                <option value="KEUANGAN">KEUANGAN</option>
                <option value="DOKTER">DOKTER</option>
            </select>
        </td> 
        <td style="width:33%;padding:10px;">
            No Handphone<br>
            <input type="number" name="hp" autocomplete="off" required>
        </td> 
        <td style="width:33%;padding:10px;">
            Jenis Kelamin<br>
            <select name="jenis_kelamin" autocomplete="off" required>
                <option value="LAKI LAKI">LAKI LAKI</option>
                <option value="PEREMPUAN">PEREMPUAN</option>
            </select>
        </td>
    </tr>
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


















