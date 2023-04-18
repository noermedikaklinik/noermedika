<?php
include "akses.php";
if(isset($_GET['alert'])){
    $alert   = $_GET['alert'];
    $message = $_GET['message'];
}
if ($akses['jabatan'] == "KASIR" or $akses["jabatan"] == "APOTEKER" or $akses["jabatan"] == "ASISTEN APOTEKER"){header ("Location:penjualan-produk?kategori_cust=UMUM&message=$message&alert=$alert");}
if ($akses['jabatan'] == "KEUANGAN"){header ("Location:keuangan");}
?>


