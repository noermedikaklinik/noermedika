<?php
include "akses.php";
if ($akses['jabatan'] <> "PENDAFTARAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";
if(!isset($_GET['no'])) header("Location:list-pasien");
$no = $_GET['no'];
$query = mysqli_query($koneksi, "SELECT * FROM db_pasien where no='$no'") or die(mysqli_error());
$data = mysqli_fetch_array($query);
?>


<form method="post" action="action/edit-pasien" enctype="multipart/form-data">
<input type="hidden" name="no" value =<?php echo "'".$no."'";?>/>
<table width="65%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2)wa;border-radius:10px;">
<td>
<table width="95%" align="center">
<td colspan="2" height="40">&nbsp;</td></tr> 
<td width="100%" style="padding:10px;"><a href="list-jasa" tooltip="Kembali ke pendaftaran" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Pasien</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Edit Pasien</b></font></td>
</table>

<table width="95%" align="center">
    <tr>
        <td class="input" colspan="2">
            No. Rekam Medis<br>
            <input type="text" name="no_rekam_medis" autocomplete="off" value =<?php echo "'".$data['no_rekam_medis']."'";?>>
        </td> 
    </tr>
    <tr>
        <td class="input" colspan="2">
            NIK<br>
            <input type="text" name="nik" autocomplete="off" value =<?php echo "'".$data['nik']."'";?>>
        </td> 
    </tr>
    <tr>
        <td class="input">Nama
        <br><input type="text" name="nama" autocomplete="off" value =<?php echo "'".$data['nama']."'";?>></td>
        <td class="input">Alamat
        <br><input type="text" name="alamat" autocomplete="off" value =<?php echo "'".$data['alamat']."'";?>></td>
    </tr>
    <tr>
        <td class="input">Tempat Lahir
        <br><input type="text" name="tempat_lahir" autocomplete="off" value =<?php echo "'".$data['tempat_lahir']."'";?>></td>
        <td class="input">Tanggal Lahir
        <br><input type="date" name="tanggal_lahir" autocomplete="off" value =<?php echo "'".$data['tanggal_lahir']."'";?>></td>
    </tr>
    <tr>
        <td class="input">No. HP
        <br><input type="text" name="no_hp" autocomplete="off" value =<?php echo "'".$data['no_hp']."'";?>></td>
        <td class="input">Pekerjaan
        <br><input type="text" name="pekerjaan" autocomplete="off" value =<?php echo "'".$data['pekerjaan']."'";?>></td>
    </tr>
    <tr width="95%" align="center">
        <td colspan="3">&nbsp;</td></tr>
        <td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Submit</button></td>
    </tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>


<script type='text/javascript'>
 /* Tanpa Rupiah */
 var tanpa_rupiah1 = document.getElementById('tanpa-rupiah1');
 tanpa_rupiah1.addEventListener('keyup', function(e)
 {
  tanpa_rupiah1.value = formatRupiah(this.value);
 });

 /* Fungsi */
 function formatRupiah(angka, prefix)
 {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
   split = number_string.split(','),
   sisa  = split[0].length % 3,
   rupiah  = split[0].substr(0, sisa),
   ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
   
  if (ribuan) {
   separator = sisa ? '.' : '';
   rupiah += separator + ribuan.join('.');
  }
  
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
 }
</script>














