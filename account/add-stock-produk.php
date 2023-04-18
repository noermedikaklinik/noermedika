<?php
include "akses.php";
if ($akses['jabatan'] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
if(isset($_GET['id_produk'])){
    $id_produk = $_GET['id_produk'];
}else{
    header("Location:list-produk");
}
include "mainhead.php";
$result1   = mysqli_query($koneksi, "SELECT * FROM db_produk where id_produk like '$id_produk'");
$produk    = mysqli_fetch_assoc($result1);
$jml       = mysqli_num_rows($result1);

$nota_beli = isset($_GET['nota_beli'])?$_GET['nota_beli']:"";
if ($jml == "" or $jml == "0"){$dataproduk = "";}
if ($jml >= "1")
{
$dataproduk = "
        <table style='width:100%;border:2px solid #d1d1d1;'>
        <td style='width:10%;padding:10px;'><img src='produk-image/$produk[foto]' style='width:100%;height:auto;'></td>
        <td style='width:90%;padding:10px;font-size:12px;'>Kode Barang : $id_produk
        <br>Nama Barang : $produk[nama_produk]
        <br>Satuan : $produk[satuan_produk]
        </td>
        </table>";}
?>



<div style="height:110px;"></div>

<form name="form1" method="get" action="add-stock-produk" enctype="multipart/form-data">
<input type="hidden" name="nota_beli" value="<?php echo "$nota_beli"; ?>">
    
<table width="60%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
    <td>
        <table width="95%" align="center">
            <td height="40">&nbsp;</td></tr>  
            <td width="100%" style="padding:10px;"><a href="list-produk" tooltip="Kembali ke list barang" flow="right">
                <i class="fa fa-arrow-left" style="color:grey;font-size:22px;"></i>
                </a> <b>Tambah Persediaan Barang</b>
            </td>  
        </table>

<div style="height:25px;"></div>

<table width="93%" align="center">
    <td tyle="padding:10px;width:70%;">
    <input type="text" name="id_produk" autocomplete="off" autofocus></td>
    <td style="padding:10px;width:30%;"><fieldset><button style="margin-top:10px;" name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Cari</button></form></td></tr>
</table>

<div style="height:25px;"></div>

<form name="form2" method="post" action="action/add-stock-produk.php" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="add-stock-produk">
    <input type="hidden" name="id_produk" value="<?php echo "$id_produk"; ?>" required>

<table width="95%" align="center">
<td colspan="4" style="padding:10px;">
<?php echo "$dataproduk"; ?>
</td></tr> 
<td style="width:25%;padding:10px;">Tanggal Nota
<br><input type="date" name="tanggal" autocomplete="off" required></td> 
<td style="width:30%;padding:10px;">No Nota Pembelian
<br><input type="text" name="nota_beli" value="<?php echo "$nota_beli"; ?>" autocomplete="off" required></td> 
<td style="width:20%;padding:10px;">Qty <i>(satuan jual)</i>
<br><input type="text" name="jumlah" id="tanpa-rupiah1" autocomplete="off" style="width:100%" required></td>
<td style="width:25%;padding:10px;">Expired
<br><input type="date" name="expired" autocomplete="off" style="width:100%" required></td></tr>
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
 
 /* Tanpa Rupiah */
 var tanpa_rupiah2 = document.getElementById('tanpa-rupiah2');
 tanpa_rupiah2.addEventListener('keyup', function(e)
 {
  tanpa_rupiah2.value = formatRupiah(this.value);
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
<script>
$(document).ready(function(){
    $("#contactus-submit").click(function(){
        var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
        $("#contactus-submit").html(r);
        $("#contactus-submit").append("  &nbsp; Submitting...");
        $("#contactus-submit").attr("disabled", true);


        setTimeout(function(){
            $("#contactus-submit").attr("disabled", false);
            $("#contactus-submit").html('Submit');

        }, 10000);
    });
});
</script>
















