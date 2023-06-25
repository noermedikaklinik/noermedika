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
?>
<div style="height:80px;"></div>



<form name="form1" method="post" action="penjualan-produk2" enctype="multipart/form-data">
<input type="hidden" name="kategori_cust" value="<?php echo "$kategori_cust"; ?>">
<table width="95%" align="center">

<?php include "dash-left-staff.php"; ?>

<td style="width:1%;"></td>

<td style="width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="95%" align="center">
  <tr>
    <td align="center" width="13%" class="padding-10">
      <div class="icon-button">
        <a href="/cari-jasa.php">
          <i class="fa fa-plus-circle icon"></i>
          <br>Jasa Lainnya
        </a>
      </div>
    </td>
    <td align="center" width="10%" class="padding-10">
      <div class="icon-button">
        <a href="/cari-barang.php">
          <i class="fa fa-search icon"></i>
          <br>Cari Barang
        </a>
      </div>
    </td> 
  </tr>
</table>

<div class="ml-5">
  <?php
        $countResep = mysqli_query($koneksi, "SELECT count(no) as count FROM db_resep where status=1") or die(mysqli_error($koneksi));
        $countResult = mysqli_fetch_array($countResep)["count"];
        if($countResult>0){?>
          <div class="row container">
            <div class="col-12">
                  Resep
            </div>
          </div>
  <?php
        $queryResep = mysqli_query($koneksi, "SELECT * FROM db_resep where status = 1") or die(mysqli_error($koneksi));
        while($data = mysqli_fetch_array($queryResep)){
            echo "
              <div class='row container justify-content-start'>
                <div class='col-2'>Poli: $data[poli]</div>
                <div class='col-3'>Nama Dokter: $data[nama_dokter]</div>
                <div class='col-2 align-self-end'>
                  <a href='./action/edit-resep?id_resep=$data[no]&status=0' class=''/>
                    <i class='fa fa-close'></i>
                    Batal gunakan resep
                  </a>
                </div>
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
</div>
<table width="95%" align="center">
  <tr>
    <td style="width:100%;padding:10px;">
      <?php include "frame-transaksi-penjualan.php"?>
    </td>
  </tr>
</table>

<table width="93%" align="center" style="padding:10px;">
<td align="right" style="width:80%;font-weight:bold;">Grand Total :</td>
<td style="width:20%;font-weight:bold;"> &nbsp; Rp. <?php echo ""; ?></td></tr>
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

</table>
</div>