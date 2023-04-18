<?php
require "akses.php";
if ($akses["jabatan"] <> "KASIR" and $akses["jabatan"] <> "APOTEKER" and $akses["jabatan"] <> "ASISTEN APOTEKER"){header ("Location:./");}
include "mainhead.php";

$kategori_cust = $_POST['kategori_cust'];
$id_konsulen   = $_POST['id_konsulen'];
$kode_trx      = $_POST['kode_trx'];
$id_produk     = $_POST['id_produk'];
$result1       = mysqli_query($koneksi, "SELECT * FROM db_produk where id_produk like '$id_produk'");
$produk        = mysqli_fetch_assoc($result1);
$jml           = mysqli_num_rows($result1);

$sqlpengunjung    = "select sum(jumlah) kunjung from db_stock_produk where id_produk like '$id_produk'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
$pengunjung1      = mysqli_fetch_object($resultpengunjung);
$jml_stock        = $pengunjung1->kunjung;
$jml_stockrp      = number_format($jml_stock,0,",",".");

$sqlpengunjung    = "select sum(qty) kunjung from db_penjualan where id_produk like '$id_produk' and status like '1'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
$pengunjung2      = mysqli_fetch_object($resultpengunjung);
$jml_terjual      = $pengunjung2->kunjung;
$jml_terjualrp    = number_format($jml_terjual,0,",",".");

$sisa_stock       = $jml_stock - $jml_terjual;

if ($jml == "" or $jml == "0"){header ("Location:penjualan-produk?kode_trx=$kode_trx&kategori_cust=$kategori_cust&id_konsulen=$id_konsulen&message=Barang tidak ditemukan&alert=alert alert-danger");}
if ($jml >= "1")
{
$dataproduk = "
        <table style='width:100%;border:2px solid #d1d1d1;'>
        <td style='width:10%;padding:10px;'><img src='produk-image/$produk[foto]' style='width:100%;height:auto;'></td>
        <td style='width:90%;padding:10px;font-size:12px;'>Kode Barang : $id_produk
        <br>Nama Barang : $produk[nama_produk]
        <br>Persediaan : $sisa_stock $produk[satuan_produk]
        </td>
        </table>";
}
?>


<div style="height:110px;"></div>


<table width="60%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
    <td>
<table width="95%" align="center">
<td height="40">&nbsp;</td></tr>  
<td width="100%" style="padding:10px;"><a href="penjualan-produk?kode_trx=<?php echo "$kode_trx"; ?>&kategori_cust=<?php echo "$kategori_cust"; ?>&id_konsulen=<?php echo "$id_konsulen";?>" tooltip="kembali ke transaksi" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Penjualan</b></font></td>  
</table>

<div style="height:25px;"></div>

<form name="form2" method="post" action="action/add-penjualan" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="add-penjualan">
    <input type="hidden" name="id_produk" value="<?php echo "$id_produk"; ?>">
    <input type="hidden" name="kode_trx" value="<?php echo "$kode_trx"; ?>">
    <input type="hidden" name="kategori_cust" value="<?php echo "$kategori_cust"; ?>">
    <input type="hidden" name="id_konsulen" value="<?php echo "$id_konsulen"; ?>">
    <input type="hidden" name="sisa_stock" value="<?php echo "$sisa_stock"; ?>">

<table width="95%" align="center">
<td colspan="4" style="padding:10px;">
<?php echo "$dataproduk"; ?>
</td></tr> 
<td style="width:33%;padding:10px;">Qty
<br><input type="number" name="jumlah" autocomplete="off" style="width:100%" autofocus></td></tr>
</table>


<div style="height:25px;"></div>

<table width="95%" align="center">
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Submit</button></form></td></tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:35px;"></div>

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
















