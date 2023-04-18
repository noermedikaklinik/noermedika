<?php
require "akses.php";
$kategori_cust = $_GET['kategori_cust'];
include "mainhead.php";
?>

<div style="height:110px;"></div>

<?php
$alert   = $_GET['alert'];
$message = $_GET['message'];
if ($message <> "")
{
?>
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    });    
</script>

<div class="container" style="width:100%;">
    <div class="<?php echo "$alert"; ?>" role="alert">
    <center><?php echo "$message"; ?></center>
    </div>
</div>

<?php 
} 
?>

<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2" ><a href="penjualan-produk?kategori_cust=UMUM" tooltip="Kembali" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Data Konsulen</b></font></td></tr>
    <td colspan="2" height="40">&nbsp;</td></tr>
    <td align="left" width="95%"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="search..."></td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:25%;padding:10px;">Detail Konsulen</th>
    <th style="width:25%;padding:10px;">Informasi Kontak</th>
    <th style="width:20%;padding:10px;">No Rekening</th>
    <th style="width:10%;padding:10px;"><center>Action</center></th>
  </tr>

<?php
$query=mysqli_query($koneksi, "SELECT * FROM db_konsulen");
$no = 0;
while ($record=mysqli_fetch_array($query)){
$no++;
if ($record['activation_status'] == "0"){$status = "<i class='fa fa-lock' style='color:red;font-size:20px;' onclick='return cek_block$no();'></i>";}
if ($record['activation_status'] == "1"){$status = "<i class='fa fa-unlock' style='color:green;font-size:20px;' onclick='return cek_block$no();'></i>";}

echo "
<script type='text/javaScript'>
function cek_block$no()
{
    tanya = confirm('Anda ingin merubah aktivasi status ?');
    if (tanya == true) return account_list();
    else return false;
}
function edit_konsulen$no() {window.location = 'penjualan-produk?id_konsulen=$record[id_user]&kategori_cust=$kategori_cust'}
</script>

<tr>
<td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
<td style='border:1px solid #d1d1d1;padding:10px;'><b>$record[nama]</b><br>$record[alamat]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$record[email]<br>$record[hp]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>$record[bank]</td>
<td style='border:1px solid #d1d1d1;padding:10px;'>
<center>
$status
&nbsp; &nbsp; 
<a tooltip='Pilih Konsulen' flow='left' ><i class='fa fa-plus' style='color:orange;font-size:18px;' onclick='return edit_konsulen$no();'></i></a>
</center>
</td>
</tr>";
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

<script src="../link/myjs.js"></script>








