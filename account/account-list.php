<?php
require "akses.php";
if ($akses['jabatan'] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

?>

<table class="table-main">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2" ><font size="4" color="#5b8ff5"><b>Data Karyawan</b></font></td></tr>
    <td colspan="2" height="40">&nbsp;</td></tr>
    <td align="left" width="95%"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="search..."></td>
    <td align="center" width="5%"><a href="add-new-account" tooltip='Tambah karyawan' flow='left'><i class="fa fa-plus-circle" style="color:green;font-size:35px;"></i></a></td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <tr class="header" height="50" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:10%;padding:10px;"><center>Foto</center></th>
    <th style="width:25%;padding:10px;">Detail Karyawan</th>
    <th style="width:25%;padding:10px;">Informasi kontak</th>
    <th style="width:20%;padding:10px;">Informasi Login</th>
    <th style="width:10%;padding:10px;"><center>Action</center></th>
  </tr>

<?php
$query=mysqli_query($koneksi,"SELECT * FROM db_user");
$no = 1;
while ($record=mysqli_fetch_array($query)){
  if ($record['activation_status'] == "0"){$status = "<a href='action/blok-user?id_user=$record[id_user]&jenis2=blok-user&status=1' tooltip='Buka Blokir Akun Karyawan' flow='left' ><i class='fa fa-lock' style='color:red;font-size:20px;' onclick='return cek_block$no();'></i></a>";}
  if ($record['activation_status'] == "1"){$status = "<a href='action/blok-user?id_user=$record[id_user]&jenis2=blok-user&status=0' tooltip='Blokir Akun Karyawan' flow='left' ><i class='fa fa-unlock' style='color:green;font-size:20px;' onclick='return cek_block$no();'></i></a>";}

  echo "
  <script type='text/javaScript'>
  function cek_block$no()
  {
      tanya = confirm('Anda ingin merubah aktivasi status ?');
      if (tanya == true) return account_list();
      else return false;
  }
  function edit_user$no() {window.location = 'edit-user-account?id_user=$record[id_user]'}
  </script>

  <tr>
  <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
  <td style='border:1px solid #d1d1d1;padding:10px;'><center><img src='staff-image/$record[foto]' style='width:50%;height:auto;border-radius:10px;'></center></td>
  <td style='border:1px solid #d1d1d1;padding:10px;'><b>$record[nama]</b><br>$record[alamat]<br><i>$record[jabatan]</i></td>
  <td style='border:1px solid #d1d1d1;padding:10px;'><b>$record[email]</b><br>$record[hp]</td>
  <td style='border:1px solid #d1d1d1;padding:10px;'><b>Username :</b> $record[username]<br><b>Password :</b> $record[password]</td>
  <td style='border:1px solid #d1d1d1;padding:10px;'>
  <center>
  $status
  &nbsp; &nbsp; 
  <a tooltip='Update Informasi Karyawan' flow='left' ><i class='fa fa-pencil' style='color:orange;font-size:18px;' onclick='return edit_user$no();'></i></a>
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








