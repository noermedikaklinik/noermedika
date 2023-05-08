<?php
include "akses.php";
if ($akses['hak_akses'] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";
?>

<table class="table-main">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2" ><font size="4" color="#5b8ff5"><b>Data Produk Jasa</b></font></td></tr>
    <td colspan="2" height="40">&nbsp;</td></tr>
    <td align="left" width="95%"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="search..."></td>
    <td align="center" width="5%"><a href="add-jasa" tooltip='Tambah produk jasa' flow='left'><i class="fa fa-plus-circle" style="color:green;font-size:35px;"></i></a></td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:25%;padding:10px;">Detail Produk Jasa</th>
    <th style="width:15%;padding:10px;">Harga Jasa</th>
    <th style="width:10%;padding:10px;"><center>Action</center></th>
  </tr>

<?php
$query=mysqli_query($koneksi,"SELECT * FROM db_jasa where view like '1' order by nama_jasa");
$no = 1;
while ($record=mysqli_fetch_array($query)){

  $hargarp = number_format($record['harga'],0,",",".");

  echo "
  <script type='text/javaScript'>
  function cek_hapus$no()
  {
      tanya = confirm('Anda ingin menghapus produk $record[nama_jasa] ?');
      if (tanya == true) return list-jasa();
      else return false;
  }
  function edit_jasa$no() {window.location = 'edit-jasa?no=$record[no]'}
  </script>

  <tr>
  <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>$record[nama_jasa]</td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $hargarp</td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>
  <center>
  <a href='action/delete-jasa?no=$record[no]' tooltip='Hapus Produk Jasa' flow='left' ><i class='fa fa-trash' style='color:red;font-size:18px;' onclick='return cek_hapus$no();'></i></a>
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








