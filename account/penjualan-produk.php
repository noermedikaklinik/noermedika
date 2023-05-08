<?php
include "akses.php";
if ($akses["hak_akses"] <> "KASIR" and $akses["hak_akses"] <> "APOTEKER" and $akses["hak_akses"] <> "ASISTEN APOTEKER" ){header ("Location:./");}

$kategori_cust = isset($_GET['kategori_cust'])?$_GET['kategori_cust']:"";
$id_konsulen   = isset($_GET['id_konsulen'])?$_GET['id_konsulen']:"";
$kode_trx  = isset($_GET['kode_trx'])?$_GET['kode_trx']:"";

if ($kategori_cust == "RESEP" and $id_konsulen == ""){header ("Location:konsulen-list2?kategori_cust=$kategori_cust&message=Pesanan obat menggunakan resep harus pilih konsulen terlebih dahulu&alert=alert alert-success");}
if ($kategori_cust == "RESEP" and $id_konsulen <> ""){$required = "required";$no_resep = "<td>Nomor Resep<br><input name='no_resep' type='text' style='width:100%;' placeholder='nomor resep' autocomplete='off' required></td></tr>";}
if ($kategori_cust == "UMUM" and $id_konsulen == "") {$required = "";}
include "mainhead.php";


if ($kode_trx == ""){$kode = mt_rand(6,999999);}
if ($kode_trx <> ""){$kode = $kode_trx;}

$tglnow = date("d-M-Y");
$jamnow = date("H:i");
?>

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

<div style="height:80px;"></div>



<form name="form1" method="post" action="penjualan-produk2" enctype="multipart/form-data">
<input type="hidden" name="kode_trx" value="<?php echo "$kode"; ?>">
<input type="hidden" name="kategori_cust" value="<?php echo "$kategori_cust"; ?>">
<input type="hidden" name="id_konsulen" value="<?php echo "$id_konsulen"; ?>">
    
<table width="95%" align="center">

<?php include "dash-left-staff.php"; ?>

<td style="width:1%;"></td>

<td style="width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="95%" align="center">
  <tr>
    <td align="center" width="13%" style="padding:10px;">
      <div class="icon-button">
        <i class="fa fa-plus-circle" style="color:grey;font-size:27px;" onclick="document.getElementById('id03').style.display='block'"></i>
        <br>Jasa Lainnya
      </div>
    </td>
    <td align="center" width="10%" style="padding:10px;">
      <div class="icon-button">
        <i class="fa fa-search" style="color:grey;font-size:27px;" onclick="document.getElementById('id02').style.display='block'"></i>
        <br>Cari Barang  
      </div>
    </td> 
  </tr>
</table>


<table width="95%" align="center">
<td style="width:100%;padding:10px;">
<?php include "frame-transaksi-penjualan.php"?>
</td></tr>
</table>

<?php
$sqlpengunjung    = "select sum(sub_total_jual) sum_total from db_penjualan where kode_trx like '$kode_trx' and status like '0'";
$resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
$pengunjung1      = mysqli_fetch_object($resultpengunjung);
$grand_total      = $pengunjung1->sum_total;
$grand_totalrp    = number_format($grand_total,0,",",".");
?>

<table width="93%" align="center" style="padding:10px;">
<td align="right" style="width:80%;font-weight:bold;">Grand Total :</td>
<td style="width:20%;font-weight:bold;"> &nbsp; Rp. <?php echo "$grand_totalrp"; ?></td></tr>
<td colspan="2" align="right" style="width:100%;font-weight:bold;"><hr style="border:0px;height:1px;background:grey;"></td></tr>
</table>



<div class ="row px-3 justify-content-end flex">
  <div class="icon-button col-2 align-center align-self-end">
    <i class='fa fa-print' style='color:grey;font-size:27px;' onclick="document.getElementById('id01').style.display='block'"></i><br>Cetak Nota</form>
  </div>
</div>

</td>
</table>

<div style="height:25px;"></div>


</td>
</table>


<div style="height:25px;"></div>

<div id="id01" class="modal" style="z-index:1000;border-radius:0px;margin-top:0px;">
    <div class="imgcontainer" style="margin-top:-20px;width:80%;">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" style="margin-top:15px;">&times;</span>
    </div>
    <div class="modal-container" style="width:65%;">

<script>
    function choosetype(){
	var val = 0;
	for (i = 0; i < document.form2.tipe.length; i++ ){
		if( document.form2.tipe[i].checked == true ){
			val = document.form2.tipe[i].value;
			if(val=='CASH'){
				document.form2.cash_terima.disabled = false;document.form2.no_kartu.disabled = true;document.form2.bank.disabled = true;document.form2.nama_pemegang.disabled = true;document.form2.expired_date.disabled = true;
			}
		    if(val=='DEBIT'){
				document.form2.cash_terima.disabled = true;document.form2.no_kartu.disabled = false;document.form2.bank.disabled = false;document.form2.nama_pemegang.disabled = false;document.form2.expired_date.disabled = false;
			}
		    if(val=='QRISBCA'){
				document.form2.cash_terima.disabled = true;document.form2.no_kartu.disabled = true;document.form2.bank.disabled = true;document.form2.nama_pemegang.disabled = true;document.form2.expired_date.disabled = true;
			}
          }
	   }
    }
</script>
    
       <form name="form2" method="post" action="action/payment" enctype="multipart/form-data">
        <input type="hidden" name="jenis" value="payment">
        <input type="hidden" name="kategori_cust" value="<?php echo "$kategori_cust";?>">
        <input type="hidden" name="kode_trx" value="<?php echo "$kode";?>">
        <input type="hidden" name="grand_total" id="grand_total" value="<?php echo "$grand_total";?>">
        
    <table width="95%" style="height:650px;background:white;border-radius:10px;margin-top:-15px;">
    <td colspan="2" height="25">&nbsp;</td></tr>    
    <td valign="top" width="50%">
    <table width="90%" align="center" style="margin-top:35px;">
    <td><b>Data Billing</b></td></tr>
    <td><br>Nama Pasien<br><input name="nama" type="text" style="width:100%;" placeholder="nama pasien" autocomplete="off"></td></tr>
    <td>Ph. Number / WA<br><input name="hp" type="text" style="width:100%;" placeholder="nomor hp" autocomplete="off"></td></tr>
    <td>Total Billing<br><input name="total_billing" id="total_billing" type="text" value="<?php echo "$grand_totalrp"; ?>" style="width:100%;" onkeyup="sum();" disabled></td></tr>
    <td>Apoteker<br><select name="id_apoteker" <?php echo "$required";?>>
    <option value=""></option>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From db_user where hak_akses like 'APOTEKER' or hak_akses like 'ASISTEN APOTEKER'");
    while ($t=mysqli_fetch_array($qry)) {
    if ($kategori_cust == "RESEP")
    {
    echo "<option value='$t[id_user]'>$t[nama]</option>";
    }
    else { echo ""; }
    }
    ?>
    </select>
    </td></tr>
    
    
    </table>
    </td>
    
    <td valign="top" width="50%">
    <table width="90%" align="center" style="margin-top:35px;">   
    <td><b>Pilih Pembayaran</b><br><br>
            <input type="radio" id="option-1" name="tipe" value="CASH" onClick="choosetype();"> CASH / TUNAI
            &nbsp; &nbsp; 
    </td></tr>

    <td><br>Nominal Pembayaran<br><input name="cash_terima" id="cash_terima" type="text" style="width:100%;" autocomplete="off"></td></tr>

    <td height="100"><br><input type="radio" id="option-2" name="tipe" value="DEBIT" onClick="choosetype();"> KARTU DEBIT<br><br>
        <table width="100%">
            <td>No Kartu Debit<br><input name="no_kartu" id="no_kartu" type="text" style="width:95%;" autocomplete="off"></td>
            <td>Nama Bank<br><input name="bank" id="bank" type="text" style="width:100%;" autocomplete="off"></td></tr>
            <td>Nama Pemegang Kartu<br><input name="nama_pemegang" id="nama_pemegang" type="text" style="width:95%;" autocomplete="off"></td>
            <td>Validity<br><input name="expired_date" id="expired_date" type="text" style="width:100%;" autocomplete="off"></td></tr>
        </table>
    </td></tr>

    <td><b>Pilih Pembayaran</b><br><br>
            <input type="radio" id="option-3" name="tipe" value="QRISBCA" onClick="choosetype();"> QRIS BCA
            &nbsp; &nbsp; 
    </td></tr>
    
    <td colspan="2" align="right"><button style="width:60%;margin-top:55px;">Submit</button></form></td></tr>
    </table>
        </td>
    </table>
    </div>
</div>


<div id="id02" class="modal" style="z-index:1000;border-radius:0px;margin-top:0px;">
    <div class="imgcontainer" style="margin-top:50px;width:86%;">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal" style="margin-top:45px;">&times;</span>
    </div>
    <div class="container-modal" style="width:75%;">
    <table width="100%" style="padding:10px;height:525px;background:white;border-radius:10px;">
    <td valign="top" style="width:95%;padding:10px;">
    <table id="table_barang" style="width:95%;padding:10px;margin-top:70px;">
    <td valign="top" colspan="6" style="width:100%;"><input type="text" id="cari_input" onkeyup="cari_barang()" placeholder="pencarian data barang..." autofocus></td></tr>
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:30%;padding:10px;">Nama Barang / Item(s)</th>
    <th style="width:10%;padding:10px;">Kategori</th>
    <th style="width:10%;padding:10px;">Persediaan</th>
    <th style="width:15%;padding:10px;">Harga Jual</th>
    <th style="width:5%;padding:10px;"><center>Action</center></th>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_produk order by nama_produk asc");
$no = 0;
while ($record=mysqli_fetch_array($query)){
    $no++;

    $harga_jual_itemrp   = number_format($record["harga_jual"],0,",",".");

    $sqlpengunjung    = "select sum(jumlah) kunjung from db_stock_produk where id_produk like '$record[id_produk]'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung1      = mysqli_fetch_object($resultpengunjung);
    $jml_stock        = $pengunjung1->kunjung;
    $jml_stockrp      = number_format($jml_stock,0,",",".");

    $sqlpengunjung    = "select sum(qty) kunjung from db_penjualan where id_produk like '$record[id_produk]' and status like '1'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung2      = mysqli_fetch_object($resultpengunjung);
    $jml_terjual      = $pengunjung2->kunjung;
    $jml_terjualrp    = number_format($jml_terjual,0,",",".");

    $sisa_stock       = $jml_stock - $jml_terjual;
    $sisa_stockrp     = number_format($sisa_stock,0,",",".");

    echo "
    <form name='form1$no' method='post' action='penjualan-produk2' enctype='multipart/form-data'>
    <input type='hidden' name='kode_trx' value='$kode'>
    <input type='hidden' name='id_produk' value='$record[id_produk]'>
    <input type='hidden' name='kategori_cust' value='$kategori_cust'>
    <input type='hidden' name='id_konsulen' value='$id_konsulen'>

    <tr>
    <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>Kode Barang : $record[id_produk]<br><b>$record[nama_produk]</b></td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>$record[kategori_produk]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>$sisa_stockrp $record[satuan_produk]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>Rp $harga_jual_itemrp / $record[satuan_produk]</td>
    <td style='border:1px solid #d1d1d1;padding:0px;'>
    <center><a tooltip='Tambahkan Ke Transaksi' flow='left'><button style='margin-top:0px;width:50px;background:none;'><i class='fa fa-plus-circle' style='color:green;font-size:25px;margin-left:0px;'></i></form></center>
    </td>
    </tr>";
}
?>

</table>
        </td></tr>
        <td height="50">&nbsp;</td>
    </table>
    </div>
<table>
<td height="100">&nbsp;</td>
</table>
</div>


<div id="id03" class="modal" style="z-index:1000;border-radius:0px;margin-top:0px;">
    <div class="imgcontainer" style="margin-top:50px;width:86%;">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal" style="margin-top:45px;">&times;</span>
    </div>
    <div class="container-modal" style="width:75%;">
    <table width="100%" style="padding:10px;height:425px;background:white;border-radius:10px;">
    <td valign="top" style="width:95%;padding:10px;">
    <table id="tableJasa" style="width:95%;padding:10px;margin-top:70px;">
      <td valign="top" colspan="6" style="width:100%;font-size:16px;">Pilih Produk Jasa</td></tr>
      <td valign="top" colspan="6" style="width:100%;">&nbsp;</td></tr>
      <tr class="header" height="35" style="background:#1d3565;color:white;">
        <th style="width:5%;padding:10px;"><center>No</center></th>
        <th style="width:30%;padding:10px;">Nama Jasa</th>
        <th style="width:15%;padding:10px;">Harga Jasa</th>
        <th style="width:5%;padding:10px;"><center>Action</center></th>
      </tr>

      <?php
      $query2=mysqli_query($koneksi, "SELECT * FROM db_jasa where view like '1' order by nama_jasa asc");
      $no2 = 0;
      while ($record2=mysqli_fetch_array($query2)){
        $no2++;

        $harga_jual_itemrp   = number_format($record2["harga"],0,",",".");

        echo "
        <form name='form2$no2' method='post' action='action/add-item-jasa' enctype='multipart/form-data'>
        <input type='hidden' name='jenis' value='add-item-jasa'>
        <input type='hidden' name='kode_trx' value='$kode'>
        <input type='hidden' name='no' value='$record2[no]'>
        <input type='hidden' name='kategori_cust' value='$kategori_cust'>
        <input type='hidden' name='id_konsulen' value='$id_konsulen'>

        <tr>
        <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no2</center></td>
        <td style='border:1px solid #d1d1d1;padding:10px;'>$record2[nama_jasa]</b></td>
        <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $harga_jual_itemrp</td>
        <td style='border:1px solid #d1d1d1;padding:0px;'>
        <center><a tooltip='Tambahkan Ke Transaksi' flow='left'><button style='margin-top:0px;width:50px;background:none;'><i class='fa fa-plus-circle' style='color:green;font-size:25px;margin-left:0px;'></i></form></center>
        </td>
        </tr>";
        }
      ?>

    </table>
        </td></tr>
        <td height="50">&nbsp;</td>
    </table>
    </div>
<table>
<td height="100">&nbsp;</td>
</table>
</div>



<script>
function cari_barang() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("cari_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("table_barang");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<script>
    var modal = document.getElementById('id01');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

    var modal = document.getElementById('id02');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

 /* Tanpa Rupiah */
 var cash_terima = document.getElementById('cash_terima');
 cash_terima.addEventListener('keyup', function(e)
 {
  cash_terima.value = formatRupiah(this.value);
 });
 
 /* Tanpa Rupiah */
 var grand_total = document.getElementById('grand_total');
 grand_total.addEventListener('keyup', function(e)
 {
  grand_total.value = formatRupiah(this.value);
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

<script src="../link/myjs.js"></script>














