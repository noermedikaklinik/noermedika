<?php
include "akses.php";
if ($akses['hak_akses'] <> "PENDAFTARAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
if(!isset($_GET['no_rekam_medis'])){
  header("Location:./pendaftaran-list-pasien.php");
}else{
  $no_rekam_medis = $_GET['no_rekam_medis'];
}
include "mainhead.php";
?>
<form method = "post" action="./action/daftar.php" class="container">
<table class="table-main">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <tr><td colspan="2" ><font size="4" color="#5b8ff5"><b>Pendaftaran</b></font></td></tr>
    <tr><td colspan="2" height="40">&nbsp;</td></tr>
    <tr>
      <td align="left" width="95%" colspan="2">
        <input type="date" id="date_filter" name="tanggal" value="<?php echo date("Y-m-d");?>">
      </td>
    </tr>
    <tr>
      <td align="left" width="95%">
        No. Rekam Medis<br>
        <input type="text" name="no_rekam_medis" value="<?php echo $no_rekam_medis;?>" readonly>
      </td>
      <td>
        <br>
        <a href="pendaftaran-list-pasien" class="btn btn-primary"><i class="fa fa-search"></i></a>
      </td>
    </tr>
    <tr>
      <td colspan=2>
          Poli Umum<br>
          <select type="text" name="umum">
            <option value=''></option>
            <?php
              $query_poli_umum = mysqli_query($koneksi, "SELECT * FROM db_dokter WHERE poli='UMUM'") or die(mysqli_error($koneksi));
              while($dokter = mysqli_fetch_array($query_poli_umum)){
                echo "<option value='$dokter[no]'>$dokter[nama]</option>";
              }
            ?>
          </select>
      </td>
    </tr>
    <tr>
      <td colspan=2>
          Poli Gigi<br>
          <select type="text" name="gigi">
            <option value=''></option>
            <?php
              $query_poli_umum = mysqli_query($koneksi, "SELECT * FROM db_dokter WHERE poli='GIGI'") or die(mysqli_error($koneksi));
              while($dokter = mysqli_fetch_array($query_poli_umum)){
                echo "<option value='$dokter[no]'>$dokter[nama]</option>";
              }
            ?>
          </select>
      </td>
    </tr>
    
    <tr>
      <td colspan=2>
          Laboratorium<br>
          <select type="text" name="laboratorium">
            <option value=false>No</option>
            <option value=true>Yes</option>
          </select>
      </td>
    </tr>
    <tr>
      <td colspan=2>
        <button type="submit" class="float-right">Daftar</button> 
      </td>
    </tr>
</table>
  </form>
    
</td>
</table>

<script src="../link/myjs.js"></script>








