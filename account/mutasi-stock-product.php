<?php
include "akses.php";
if ($akses['hak_akses'] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

if(isset($_GET['id_produk'])){
  $id_produk = $_GET['id_produk'];
}else{
  $id_produk = null;
}
?>


<div style="height:110px;"></div>

<script>
$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Processing...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Cari');

}, 10000);
});
});
</script>


<form name="form" method="post" action="mutasi-stock-product" enctype="multipart/form-data">
    
<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td style="padding:20px;">
<table style="width:95%;margin-top:30px;">
    <td colspan="3" width="100%"><a href="list-produk" tooltip="Kembali ke data produk" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:22px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Histori Persediaan Barang</b></font></td></tr>  
    <td colspan="3" height="40">&nbsp;</td></tr>
    <td style="width:45%;">Cari Data Barang<br><input type="text" id="myInput" onkeyup="myFunction()" placeholder="search..." style="width:98%;" autocomplete="off"></td>
    <td style="width:35%;">Pilih Periode
    <br><input type="date" name="tgl1" style="width:45%"> &nbsp; <input type="date" name="tgl2" style="width:45%"></td>
    <td style="width:15%;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending" style="margin-top:25px;"><i id="icon" class=""></i> Cari</button></form></td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:7%;padding:10px;"><center>Tanggal</center></th>
    <th style="width:25%;padding:10px;">Nama Produk / Supplier</th>
    <th style="width:10%;padding:10px;">ID Transaksi</th>
    <th style="width:7%;padding:10px;">Stock Masuk</th>
    <th style="width:7%;padding:10px;">Satuan</th>
    <th style="width:5%;padding:10px;"><center>Action</center></th>
  </tr>

<?php

$tgl1  = isset($_POST['tgl1'])?$_POST['tgl1']:"";
$tgl2  = isset($_POST['tgl2'])?$_POST['tgl2']:"";

if ($tgl1 == "" and $tgl2 == ""){$filter = "order by sp.no desc";}
if ($tgl1 <> "" and $tgl2 == ""){$filter = "where tanggal like '$tgl1'order by sp.no desc";} 
if ($tgl1 <> "" and $tgl2 <> ""){$filter = "where tanggal between '$tgl1' and '$tgl2' order by sp.no desc";} 

$query=mysqli_query($koneksi,"SELECT sp.*, s.nama as nama_supplier, p.nama_produk, p.satuan_produk FROM db_stock_produk sp
                              left join db_produk p on p.id_produk = sp.id_produk 
                              left join db_supplier s on s.id_user = sp.id_supplier $filter");
$no = 1;
while ($record=mysqli_fetch_array($query)){

  $result1 = mysqli_query($koneksi, "SELECT * FROM db_produk where id_produk like '$record[id_produk]'");
  $produk  = mysqli_fetch_assoc($result1);

  $result1   = mysqli_query($koneksi, "SELECT * FROM db_supplier where id_user like '$record[id_supplier]'");
  $supplier  = mysqli_fetch_assoc($result1);

  $jumlahrp = number_format($record['jumlah'],0,",",".");

  echo "
  <script type='text/javaScript'>
  function cek_del$no()
  {
      tanya = confirm('Anda ingin membatalkan transaksi stok produk masuk nota $record[nota]?');
      if (tanya == true) return account_list();
      else return false;
  }
  </script>

  <tr>
  <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
  <td style='border:1px solid #d1d1d1;padding:10px;'><center>$record[tanggal]</center></td>
  <td style='border:1px solid #d1d1d1;padding:10px;'><b>Kode Barang : $record[id_produk]</b><br>$record[nama_produk]<br><i>$record[nama_supplier]</i></td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>$record[nota]</td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>$jumlahrp</td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>$record[satuan_produk]</td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>
  <center>
  <a href='action/delete-produk-masuk?no=$record[no]' tooltip='Hapus Transaksi Stock Produk Masuk' flow='left'><i class='fa fa-trash' style='color:red;font-size:18px;' onclick='return cek_del$no();'></i></a>
  </center>
  </td>
  </tr>";
  $no++;

}
?>
</table>

<div style="height:35px;"></div>
    
</td>
</table>

<div style="height:45px;"></div>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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

<script src="../link/myjs.js"></script>








