<?php
include "akses.php";
if(isset($_GET['alert'])){
    $alert   = $_GET['alert'];
    $message = $_GET['message'];
}
if ($akses['hak_akses'] == "KASIR" or $akses["hak_akses"] == "APOTEKER" or $akses["hak_akses"] == "ASISTEN APOTEKER"){header ("Location:penjualan-produk?kategori_cust=UMUM&message=$message&alert=$alert");}
if ($akses['hak_akses'] == "KEUANGAN"){header ("Location:keuangan");}
if ($akses['hak_akses'] == "PENDAFTARAN"){header("Location:pendaftaran"); }
if ($akses['hak_akses'] == "ADMIN"){header ("Location:keuangan");}
if ($akses['hak_akses'] == "DOKTER"){header ("Location:dokter");}
?>


