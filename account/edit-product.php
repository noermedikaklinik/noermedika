<?php
include "./akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$id_produk = $_GET['id_produk'];
$result1   = mysqli_query($koneksi, "SELECT * FROM db_produk where id_produk like '$id_produk'");
$produk    = mysqli_fetch_assoc($result1);

$result1   = mysqli_query($koneksi, "SELECT * FROM db_supplier where id_user like '$produk[id_supplier]'");
$supplier  = mysqli_fetch_assoc($result1);

$harga_belirp     = number_format($produk["harga_beli"],0,",",".");
$harga_jualrp     = number_format($produk["harga_jual"],0,",",".");
?>
<script>
var htmlobjek;
$(document).ready(function(){
  $("#jenis_produk").change(function(){
    var jenis_produk = $("#jenis_produk").val();
    $.ajax({
        url: "take-kategori.php",
        data: "jenis_produk="+jenis_produk,
        cache: false,
        success: function(msg){
            $("#kategori").html(msg);
        }
    });
  });
});

$(document).ready(function(){
  $("#kategori").change(function(){
    var kategori = $("#kategori").val();
    $.ajax({
        url: "take-sub-kategori.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            $("#sub_kategori").html(msg);
        }
    });
  });
});
</script>

<form method="post" action="./action/update-product.php" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="edit-produk">
    <input type="hidden" name="id_produk" value="<?php echo "$id_produk";?>">
    <input type="hidden" name="image" value="<?php echo "$produk[foto]";?>">

<table class="table-main">
    <tr>
        <td height="40">&nbsp;</td></tr>  
        <td colspan="3">
            <a href="list-produk" tooltip="Kembali ke list barang" flow="right">
                <i class="fa fa-arrow-left" style="color:grey;font-size:22px;"></i>
            </a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Ubah Data Barang</b></font>
        </td>  
    </tr>
    <div style="height:10px;"></div>
    <tr>
        <td style="padding:10px;">
            <br>
            <img src="produk-image/<?php echo "$produk[foto]";?>" class="image-display">
            <br><input type="file" name="doc1">
        </td>
    </tr>
    <tr>
        <td style="padding:10px;"><font size="2"><b>Informasi Barang</b></font></td>
    </tr>

    <tr>
        <td>Kode Barang
            <br><input type="text" name="id_produk" value="<?php echo "$produk[id_produk]";?>" autocomplete="off" required>
        </td>
        <td colspan="2">
            Nama Barang
            <br>
            <input type="text" name="nama" value="<?php echo "$produk[nama_produk]";?>" autocomplete="off" required>
        </td> 
    </tr>

    <tr>
        <td>
            Kategori<br>
            <select name="kategori" id="kategori" autocomplete="off" required>
                <option value="<?php echo "$produk[kategori_produk]";?>"><?php echo "$produk[kategori_produk]";?></option>
                <option value=""></option>
                <option value="ALKES">ALKES</option>
                <option value="OBAT OBATAN">OBAT OBATAN</option>
                <option value="MAKANAN">MAKANAN</option>
                <option value="MINUMAN">MINUMAN</option>
                <option value="PERLENGKAPAN">PERLENGKAPAN</option>
            </select>
        </td>
        <td>
            Satuan Jual<br>
            <select name="satuan" id="satuan" autocomplete="off" required>
                <option value="<?php echo "$produk[satuan_produk]";?>"><?php echo "$produk[satuan_produk]";?></option>
                <option value=""></option>
                <option value="BOTOL">BOTOL</option>
                <option value="BOX">BOX</option>
                <option value="KAPLET">KAPLET</option>
                <option value="PCS">PCS</option>
                <option value="SACHET">SACHET</option>
                <option value="STRIP">STRIP</option>
                <option value="TUBE">TUBE</option>
            </select>
        </td>
        <td>
            Pilih Supplier<br>
            <select name="id_supplier" autocomplete="off" required>
                <option value="<?php echo "$produk[id_supplier]";?>" selected><?php echo "$supplier[nama]";?></option>
                <option value=""></option>
                <?php               
                $query=mysqli_query($koneksi, "SELECT * FROM db_supplier");
                while ($record=mysqli_fetch_array($query))
                {
                    echo "<option value='$record[id_user]'>$record[nama]</option>";
                } 
                ?>
            </select>
        </td>   
    </tr>
    <tr>
        <td>
            Harga Beli Satuan <i>(incl ppn)</i><br>
            <input type="text" name="harga_beli" value="<?php echo "$harga_belirp";?>" id="tanpa-rupiah1" autocomplete="off">
        </td>
        <td>
            Harga Jual Satuan<br>
            <input type="text" name="harga_jual" value="<?php echo "$harga_jualrp";?>" id="tanpa-rupiah2" autocomplete="off">
        </td>
        <td>
            Minimum Stock Satuan Jual<br>
            <input type="text" name="min_stok" value="<?php echo "$produk[min_stok]";?>" id="tanpa-rupiah3" autocomplete="off">
        </td>
    </tr>
    <tr>
        <td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Update</button></td></tr>
    </tr>
</table>



<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>


<script type='text/javascript'>
 /* Tanpa Rupiah */
 var tanpa_rupiah1 = document.getElementById('tanpa-rupiah1');
 tanpa_rupiah1.addEventListener('keyup', function(e)
 {
  tanpa_rupiah1.value = formatRupiah(this.value);
 });
 /* Tanpa Rupiah */
 var tanpa_rupiah2 = document.getElementById('tanpa-rupiah2');
 tanpa_rupiah2.addEventListener('keyup', function(e)
 {
  tanpa_rupiah2.value = formatRupiah(this.value);
 });
 /* Tanpa Rupiah */
 var tanpa_rupiah3 = document.getElementById('tanpa-rupiah3');
 tanpa_rupiah3.addEventListener('keyup', function(e)
 {
  tanpa_rupiah3.value = formatRupiah(this.value);
 });
 /* Tanpa Rupiah */
 var tanpa_rupiah4 = document.getElementById('tanpa-rupiah4');
 tanpa_rupiah4.addEventListener('keyup', function(e)
 {
  tanpa_rupiah4.value = formatRupiah(this.value);
 });
 /* Tanpa Rupiah */
 var tanpa_rupiah5 = document.getElementById('tanpa-rupiah5');
 tanpa_rupiah5.addEventListener('keyup', function(e)
 {
  tanpa_rupiah5.value = formatRupiah(this.value);
 });
  /* Tanpa Rupiah */
 var tanpa_rupiah6 = document.getElementById('tanpa-rupiah6');
 tanpa_rupiah6.addEventListener('keyup', function(e)
 {
  tanpa_rupiah6.value = formatRupiah(this.value);
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