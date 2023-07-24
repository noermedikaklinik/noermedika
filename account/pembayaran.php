<?php
include "akses.php";
if ($akses["hak_akses"] <> "KASIR" and $akses["hak_akses"] <> "APOTEKER" and $akses["hak_akses"] <> "ASISTEN APOTEKER" ){header ("Location:./");}
require("./action/count-total.php");
include "mainhead.php";
?>
<form class="container table-main px-5" method ="post" action="./action/payment.php">
  <div class="p-20px">
    <div class="row">
      <div class="col-12">
        <div class="text-primary font-weight-bold h3 mb-5">Pembayaran</div>
      </div> 
      <div class="col-12 mt-3">
        <input type="text" name="nama" placeholder = "Nama" autocomplete="off">
      </div>
      <div class="col-12 mt-3">
        <input type="text" name="phone_number" placeholder = "Nomor Handphone" autocomplete="off">
      </div>
      <div class="col-12 mt-3">
          <?php 
            $totalFormatted  = number_format($grand_total,0,",",".");
            echo "<input type='text' name='billing' value = 'Rp. $totalFormatted' placeholder = 'Pembayaran' autocomplete='off' readonly>"; 
          ?>
          
      </div>
      <div class="col-12 mt-3">
        <input type="number" name="cash_terima" placeholder = "Jumlah Bayar" autocomplete="off" id="jumlah_bayar">
      </div>
      <div class="col-12 mt-3">
          <?php 
            $totalFormatted  = number_format($grand_total,0,",",".");
            echo "<input type='text' name='billing' value = '-Rp. $totalFormatted' placeholder = 'Pembayaran' autocomplete='off' readonly id='jumlah_kembali'> "; 
          ?>
          
      </div>
      <div class="col-3 mt-3">
        <button name="submit" type="submit" data-submit="...Sending">Bayar</button>
      </div>
      <input type='hidden' id="grand_total" value=<?php echo $grand_total; ?>>
    </div>
  </div>
</form>
<script>
  
$(document).ready(function(){
  var grand_total = $("#grand_total").val();
  $("#jumlah_bayar").keyup(function(){
    var jumlah_bayar = $("#jumlah_bayar").val();
    var jumlah_kembali = jumlah_bayar-grand_total;
    let formatRupiah = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
    }).format(jumlah_kembali);
    $("#jumlah_kembali").val(formatRupiah);
  });
});
</script>
</script>
<script src="../link/myjs.js"></script>








