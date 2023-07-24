<?php
include "akses.php";
if ($akses["hak_akses"] <> "KASIR" and $akses["hak_akses"] <> "APOTEKER" and $akses["hak_akses"] <> "ASISTEN APOTEKER" ){header ("Location:./");}
include "mainhead.php";
?>

<div class="container">
  <div class="row custom-card w-100 mt-5">
      <div class="row col-12 p-5 ml-1">
        <td colspan="2"><font size="4" color="#5b8ff5"><b>Daftar harga jasa</b></font></td></tr>
        <td colspan="3" height="40">&nbsp;</td></tr>
      </div>
      <table id="dataTable" class="p-5 w-100 mx-5" >
        <?php require "./paging/paging-list-jasa-kasir.php";?>
      </table>
  </div>
</div>








