<?php
include "akses.php";
if ($akses['hak_akses'] <> "PENDAFTARAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";
?>

<table class="table-main">
<td style="padding:20px;">
<table style="width:95%;padding:20px;margin-top:30px;">
    <td colspan="2" ><font size="4" color="#5b8ff5"><b>Pendaftaran</b></font></td></tr>
    <td colspan="2" height="40">&nbsp;</td></tr>
    <td align="left" width="95%">
        <input type="date" id="date_filter"value="<?php echo date("Y-m-d");?>">
    </td>
</table>

<table id="myTable" style="width:95%;padding:20px;margin-top:20px;">
  <?php require "paging-list-pendaftaran.php";?>
</table>

<div style="height:35px;"></div>
    
</td>
</table>

<div style="height:45px;"></div>

<script>
$(document).ready(function(){
  $("#date_filter").change(function(){
    var date_filter = $("#date_filter").val();
    alert(date_filter);
  });
});
</script>

<script src="../link/myjs.js"></script>








