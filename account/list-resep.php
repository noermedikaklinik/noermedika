<?php
include "akses.php";
if ($akses["hak_akses"] <> "KASIR" and $akses["hak_akses"] <> "APOTEKER" and $akses["hak_akses"] <> "ASISTEN APOTEKER" ){header ("Location:./");}
include "mainhead.php";
?>
<div class="container">
  <table class="table-main">
    <div class="custom-space"></div>
  <td style="padding:20px;">

  <table class="table-main">

  <?php require "./paging/paging-list-resep.php";?>
  </table>

    <div id="paging-button" class="d-flex flex-row">
      <button id='first-button' class='pagination-button'>first page</button>
      <button id='prev-button' class='pagination-button'>prev</button>
      <button id='page-number' class='pagination-button' disabled>1</button>
      <button id='next-button' class='pagination-button'>next</button>
      <button id='last-button' class='pagination-button'>last page</button>
    </div>
  <div style="height:35px;"></div>
      
  </td>
  </table>
</div>
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
        url: "./action/paging-list-produk.php",
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








