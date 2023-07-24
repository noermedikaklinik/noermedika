<?php
include "akses.php";
if ($akses["hak_akses"] <> "KASIR" and $akses["hak_akses"] <> "APOTEKER" and $akses["hak_akses"] <> "ASISTEN APOTEKER" ){header ("Location:./");}
include "mainhead.php";
?>
<div class="container">
<table class="table-main">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2" ><font size="4" color="#5b8ff5"><b>Pendaftaran</b></font></td></tr>
    <td colspan="2" height="40">&nbsp;</td></tr>
    <td align="left" width="95%">
        <input type="date" id="date_filter"value="<?php echo date("Y-m-d");?>">
    </td>
</table>

<table class="table-data" id ="table-data">
  <?php require "./paging/paging-list-pendaftaran-kasir.php";?>
</table>

<div style="height:35px;"></div>
    
</td>
</table>
<div>
<div style="height:45px;"></div>

<script>
$(document).ready(function(){
  $("#date_filter").change(function(){
    var date_filter = $("#date_filter").val();
    $.ajax({
        url: "./paging-list-pendaftaran.php?filter="+date_filter,
        cache: false,
        success: function(msg){
            $("#table-data").html(msg);
        }
    });
  });
});
</script>

<script src="../link/myjs.js"></script>








