<?php
include "akses.php";
require("./action/count-total.php");
if ($akses["hak_akses"] <> "KASIR" and $akses["hak_akses"] <> "APOTEKER" and $akses["hak_akses"] <> "ASISTEN APOTEKER" ){header ("Location:./");}

$kategori_cust = isset($_GET['kategori_cust'])?$_GET['kategori_cust']:"";
$id_konsulen   = isset($_GET['id_konsulen'])?$_GET['id_konsulen']:"";
$kode_trx  = isset($_GET['kode_trx'])?$_GET['kode_trx']:"";

if ($kategori_cust == "RESEP" and $id_konsulen == ""){header ("Location:konsulen-list2?kategori_cust=$kategori_cust&message=Pesanan obat menggunakan resep harus pilih konsulen terlebih dahulu&alert=alert alert-success");}
if ($kategori_cust == "RESEP" and $id_konsulen <> ""){$required = "required";$no_resep = "<td>Nomor Resep<br><input name='no_resep' type='text' style='width:100%;' placeholder='nomor resep' autocomplete='off' required></td></tr>";}
if ($kategori_cust == "UMUM" and $id_konsulen == "") {$required = "";}

include "mainhead.php";
?>

<form name="form1" method="post" action="penjualan-produk2" enctype="multipart/form-data">
<input type="hidden" name="kategori_cust" value="<?php echo "$kategori_cust"; ?>">
<div class="container">
  <div class="row">
      <div class="col-md-12 col-12 custom-card px-5">
        <div class="row mt-5">
          <div class="col-4 text-center">
            <div class="icon-button">
              <a href="./kasir-cari-jasa.php">
                <i class="fa fa-plus-circle icon"></i>
                <br>Jasa Lainnya
              </a>
            </div>
          </div>
          <div class="col-4 text-center">
            <div class="icon-button">
              <a href="./kasir-cari-barang.php">
                <i class="fa fa-search icon"></i>
                <br>Cari Barang
              </a>
            </div>
          </div>
          <div class="col-4 text-center">
            <div class="icon-button">
              <a href="./kasir-pendaftaran.php">
                <i class="fa fa-file-text-o icon"></i>
                <br>Pendaftaran
              </a>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <?php
            $selectPendaftaran = "SELECT *, db_pendaftaran.no as id_pendaftaran FROM db_pendaftaran 
            INNER JOIN db_pasien on db_pendaftaran.id_pasien = db_pasien.no
            WHERE is_paid =1";
            $resultPendaftaran = mysqli_query($koneksi, $selectPendaftaran);
            while($data = mysqli_fetch_array($resultPendaftaran)){

              ?>
                <div class="col-12 row">
                  <div class="col-2">Nama Pasien</div>
                  <div class="col-3">:<?php echo $data['nama']; ?></div>
                  <div class="col-2">No Rekam Medis</div>
                  <div class="col-3">:<?php echo $data['no_rekam_medis']; ?></div>
                  <div class="col-2">
                    <?php
                      echo '<a href="./action/kasir-batal-pendaftaran.php?id_pendaftaran='.$data["id_pendaftaran"].'"> Batal</a>';
                    ?>
                  </div>
                </div>
                <table id="myTable" style="width:100%;padding:10px;margin-top:0px;" class="mt-5">
                    <tr class="header" height="35" style="background:#1d3565;color:white;">
                      <th style="width:5%;padding:10px;"><center>No</center></th>
                      <th style="width:55%;padding:10px;">Dokter</th>
                      <th style="width:15%;padding:10px;">Total</th>
                    </tr>
                    <?php
                      $selectTindakan = mysqli_query($koneksi, "SELECT * FROM db_pendaftaran_tindakan
                      INNER JOIN db_dokter on db_dokter.no = db_pendaftaran_tindakan.id_dokter
                      WHERE db_pendaftaran_tindakan.id_pendaftaran = $data[id_pendaftaran]");
                      $no = 0;
                      if(mysqli_num_rows($selectTindakan) == 0){
                        ?>
                          <tr><td colspan=3>Tidak dilakukan tindakan</td><tr>
                        <?php
                      }
                      while($tindakan = mysqli_fetch_array($selectTindakan)){
                          $hargaDokterFormatted  = number_format($tindakan['harga'],0,",",".");
                        ?>
                            <tr>
                              <td><?php echo $no;?> </td>
                              <td><?php echo $tindakan['nama'];?></td>
                              <td><?php echo $hargaDokterFormatted;?></td>
                            </tr>
                        <?php
                        $no++;
                      }
                    ?>
                </table>
              <?php
              ;
            }
          ?>
        </div>
        <div class="row mt-5">
        <?php
              $countResep = mysqli_query($koneksi, "SELECT count(no) as count FROM db_resep where status=1") or die(mysqli_error($koneksi));
              $countResult = mysqli_fetch_array($countResep)["count"];
              if($countResult>0){?>
        <?php
        $queryResep = mysqli_query($koneksi, "SELECT * FROM db_resep where status = 1") or die(mysqli_error($koneksi));
        while($data = mysqli_fetch_array($queryResep)){
            echo "
              <div class='row container justify-content-start'>
                <div class='col-2'>Poli: $data[poli]</div>
                <div class='col-3'>Nama Dokter: $data[nama_dokter]</div>
                
              </div>
              <div class='row container'>
                <div class='col-12'>
                  <textarea readonly>$data[resep]</textarea>
                </div>
              </div>
            ";
        }
  }
  ?>
        <?php include "./paging/frame-transaksi-penjualan.php"?>
        </div>
        <div class="row">
          <div class="col-6"></div>
          <div class="col-3">Total</div>
          <div class="col-3">&nbsp; Rp. <?php 
            //$total didapat dari action/count-total.php
            $totalFormatted  = number_format($total,0,",",".");
            echo $totalFormatted; 
          ?></div>
        </div> <div class="row">
          <div class="col-6"></div>
          <div class="col-3">PPN</div>
          <div class="col-3">&nbsp; Rp. <?php 
            //$total didapat dari action/count-total.php
            $totalFormatted  = number_format($ppn,0,",",".");
            echo $totalFormatted; 
          ?></div>
        </div> <div class="row">
          <div class="col-6"></div>
          <div class="col-3">Grand Total</div>
          <div class="col-3">&nbsp; Rp. <?php 
            //$total didapat dari action/count-total.php
            $totalFormatted  = number_format($grand_total,0,",",".");
            echo $totalFormatted; 
          ?></div>
        </div>
        <div class ="row px-3 justify-content-end flex">
          <div class="icon-button col-2 align-center align-self-end">
            <a href="./pembayaran">
              <i class='fa fa-print' style='color:grey;font-size:27px;'></i><br>Cetak Nota</form>
            </a>
          </div>
        </div>
      </div>
  </div>
</div>
</form>





</td>
</table>

<div style="height:25px;"></div>

</table>
</div>