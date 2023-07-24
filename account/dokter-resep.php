<?php
include "akses.php";
if ($akses['hak_akses'] <> "DOKTER"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";
$id_pendaftaran = $_GET['id_pendaftaran'];
$queryPasien = mysqli_query($koneksi, "SELECT pasien.* FROM db_pendaftaran pendaftaran 
                                        INNER JOIN db_pasien pasien on pasien.no = pendaftaran.id_pasien
                                        WHERE pendaftaran.no ='$id_pendaftaran'") or die(mysqli_error($koneksi));
$pasien = mysqli_fetch_array($queryPasien);
$id_pasien= $pasien['no'];
$query_pemeriksaan = mysqli_query($koneksi, "SELECT * FROM db_resep WHERE id_pasien = '$id_user' ORDER BY tanggal, no desc") or die(mysqli_error($koneksi))
?>
<form method = "post" action="./action/dokter-resep.php" class="container">
  <input type="hidden" name="id_pendaftaran" value = "<?php echo $id_pendaftaran; ?>"/>
<table class="table-main">
  <tr>
    <td style="padding:20px;">
      <table style="width:95%;padding:20px;margin-top:30px;">
          <tr><td colspan="2" ><font size="4" color="#5b8ff5"><b>Pendaftaran</b></font></td></tr>
          <tr><td colspan="2" height="40">&nbsp;</td></tr>
          <tr>
            <td colspan=2>
              Nama <br>
              <input type="text" name="nama" value="<?php echo $pasien['nama'];?>" disabled>
              <input type="hidden" name="id_pasien" value="<?php echo $id_pasien; ?>">
            </td>
          </tr>
          <tr>
            <td colspan=2>
              Resep <br>
              <textarea id="resep" name="resep" rows="4" cols="50"></textarea>
            </td>
          </tr>
          <tr>
            <td width="80%">
            </td>
            <td>
              <button type="submit" class="absolute r-0">Tambahkan</button>
            </td>
          </tr>
          
      </table>

      <table class="table-data" id ="table-data">
        <tr>
          <td>Tanggal</td>
          <td>Poli</td>
          <td>Dokter</td>
          <td>Resep</td>
        </tr>
        <?php
          while($pemeriksaan = mysqli_fetch_array($query_pemeriksaan)){
            echo 
            "
              <tr>
                <td>$pemeriksaan[tanggal]</td>
                <td>$pemeriksaan[poli]</td>
                <td>$pemeriksaan[nama_dokter]</td>
                <td>$pemeriksaan[resep]</td>
              </tr>
            ";
          }
        ?>
      </table>
    </td>
  </tr>
</table>
</form>
<script src="../link/myjs.js"></script>








