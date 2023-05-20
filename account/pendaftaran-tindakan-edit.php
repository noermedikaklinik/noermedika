<?php
include "akses.php";
if ($akses['hak_akses'] <> "PENDAFTARAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
if(!isset($_GET['no_pendaftaran'])){
  header("Location:./pendaftaran.php");
}else{
  $no = $_GET['no_pendaftaran'];
  $query_pasien = mysqli_query($koneksi, "SELECT pasien.* FROM db_pasien pasien, db_pendaftaran pendaftaran WHERE 
                      pendaftaran.id_pasien = pasien.no AND
                      pendaftaran.no = '$no'") or die(mysqli_error($koneksi));
  $pasien = mysqli_fetch_array($query_pasien);
  $umum = null;
  $gigi = null;
  $labor = false;
  $query_tindakan = mysqli_query($koneksi, "SELECT dokter.* FROM db_dokter dokter, db_pendaftaran_tindakan tindakan WHERE
                                  tindakan.id_dokter = dokter.no AND
                                  tindakan.id_pendaftaran = '$no'") or die(mysqli_error($koneksi));
  while($tindakan = mysqli_fetch_array($query_tindakan)){
    if($tindakan['poli'] == 'UMUM') $umum = $tindakan;
    else if ($tindakan['poli'] == 'GIGI') $gigi = $tindakan;
    else if ($tindakan['poli'] == 'LABORATORIUM') $labor = true;
  }
}
include "mainhead.php";
?>
<form method = "post" action="./action/daftar.php">
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
      <td width="95%">
        No. Rekam Medis<br>
        <input type="text" name="no_rekam_medis" value="<?php echo $pasien['no_rekam_medis'];?>" readonly>
      </td>
    </tr>
    <tr>
      <td colspan=2>
          Poli Umum<br>
          <select type="text" name="umum">
            <option value=''></option>
            <?php
              if($umum != null)echo "<option value='$umum[no]' selected>$umum[nama]</option>";
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
              if($gigi != null)echo "<option value='$gigi[no]' selected>$gigi[nama]</option>";
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
            <?php
              if($labor){
                echo "<option value='true' selected>Yes</option>";
              }else{
                echo "<option value='false' selected>No</option>";
              }
            ?>
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
<div style="height:35px;"></div>
    
</td>
</table>

<div style="height:45px;"></div>

<script src="../link/myjs.js"></script>








