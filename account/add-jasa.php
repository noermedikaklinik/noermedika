<?php
include "akses.php";
if ($akses['jabatan'] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

?>


<form method="post" action="action/add-jasa" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="tambah-jasa">

<table width="65%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2)wa;border-radius:10px;">
<td>
<table width="95%" align="center">
<td colspan="2" height="40">&nbsp;</td></tr> 
<td width="100%" style="padding:10px;"><a href="list-jasa" tooltip="Kembali ke data produk jasa" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Produk Jasa</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Detail Produk Jasa</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:33%;padding:10px;">Nama Produk Jasa
<br><input type="text" name="nama_jasa" autocomplete="off"></td> 
<td style="width:33%;padding:10px;">Harga Satuan
<br><input type="text" name="harga" id="tanpa-rupiah1" autocomplete="off"></td></tr>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td colspan="3">&nbsp;</td></tr>
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Submit</button></td></tr>
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














