<?php
include "akses.php";
if ($akses['jabatan'] <> "PENDAFTARAN"){header("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";
?>

<table class="table-main">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2"><font size="4" color="#5b8ff5"><b>Data Persediaan Barang</b></font></td></tr>
    <td colspan="3" height="40">&nbsp;</td></tr>
    <td align="left" width="85%"><input type="text" id="filter" placeholder="pencarian data barang..." autofocus></td>
    <td align="right" width="15%"><a href="add-new-product" tooltip='Tambah item baru' flow='left'><i class="fa fa-plus-circle" style="color:green;font-size:35px;"></i></a> &nbsp; &nbsp; &nbsp; <a href='mutasi-stock-product' tooltip='Riwayat Barang Masuk' flow='left' ><i class='fa fa-exchange' style='color:red;font-size:30px;'></i></a></td>
</table>

<table id="dataTable" style="width:95%;padding:20px;margin-top:20px;">

<?php require "./paging-list-pasien.php";?>
</table>

  <div id="paging-button" class="d-flex flex-row">
  <button id = 'first-button' class='pagination-button'>first page</button>
    <button id='prev-button' class='pagination-button'>prev</button>
    <button id="page-number" class='pagination-button' disabled>1</button>
    <button id = 'next-button' class='pagination-button'>next</button>
    <button id = 'last-button' class='pagination-button'>last page</button>
  </div>
<div style="height:35px;"></div>
    
</td>
</table>

<div style="height:45px;"></div>

<script>
$(document).ready(function(){
  var halaman = 1;
  $("#filter").change(function(){
    var filter = $("#filter").val();
    pagination(filter, 1);
  });
  
  $("#next-button").click(function(){
    var filter = $("#filter").val();
    pagination(filter, halaman+1);
  });
  $("#prev-button").click(function(){
    var filter = $("#filter").val();
    pagination(filter, halaman-1);
  });
  
  $("#first-button").click(function(){
    var filter = $("#filter").val();
    pagination(filter, 1);
  });
  $("#last-button").click(function(){
    var filter = $("#filter").val();
    pagination(filter, 1);
  });
  function pagination(filter, get_halaman){
    $.ajax({
        url: "./paging-list-pasien.php",
        data: "filter="+filter+"&halaman="+get_halaman,
        cache: false,
        success: function(msg){
            $("#dataTable").html(msg);
            halaman = get_halaman;
            $("#page-number").html(get_halaman);
        }
    });
  }
});
</script>

<script src="../link/myjs.js"></script>








