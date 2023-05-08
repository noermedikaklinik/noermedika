<?php 
require_once "akses.php";
if ($akses["hak_akses"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$thnnow  = date("Y");
$thnlalu = $thnnow - 1; 

$tglnow = date("d-M-Y");
$jamnow = date("H:i");
?>

<div style="height:100px;"></div>

<table width="95%" align="center">

<?php include "dash-left-keuangan.php"; ?>

<td style="width:1%;"></td>

<td valign="top" style="height:600px;width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="90%" style="margin-top:30px;">
<td><font size="3"><b>APOTEK NOER MEDIKA</b></font></td></tr>
<td><font size="3">NERACA USAHA</font></td></tr>
<td><font size="2">PER <?php $tglnow = date("d-M-Y"); echo "$tglnow"; ?></font></td></tr>
<td height="20"><hr></td></tr>
</table>

<table width="90%" style="margin-top:0px;">
    <td width="50%" valign="top" style="border:0px solid #d1d1d1;border-radius:5px;">
    <table width="100%">
<td><b>AKTIVA</b></td></tr>

<td colspan="2">&nbsp;</td></tr>

<td><b>KAS DAN SETARA KAS</b></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'KAS' order by id asc");
    while ($record1=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'KAS' and nama_akun like '$record1[name]'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga1=$pengunjung->kunjung;
    $a1 = $totalpengunjunga1;
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'KAS' and nama_akun like '$record1[name]'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb1=$pengunjung->kunjung;
    $b1 = $totalpengunjungb1;
    $saldo = $a1 - $b1;
    $saldorp  = number_format($saldo,2,",",".");
    ?>
    <td width="70%"><?php echo "$record1[id]"; ?> - <?php echo "$record1[name]"; ?></td>
    <td width="30%">
        <table width="100%">
            <td width="50%"><?php echo "$saldorp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr>
    <?php    
    }
    ?>

<td colspan="2">&nbsp;</td></tr>

<td><b>PERSEDIAAN</b></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'PERSEDIAAN' order by id asc");
    while ($record19=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'PERSEDIAAN' and year(tanggal) like '$thnnow' and nama_akun like '$record19[name]'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga19=$pengunjung->kunjung;
    $a19 = $totalpengunjunga19;

    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PERSEDIAAN' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga39=$pengunjung->kunjung;
    $a39 = $totalpengunjunga39;
    $persediaan = $a19 - $a39;
    $persediaanrp  = number_format($persediaan,2,",",".");
    ?>
    <td><?php echo "$record19[id]"; ?> - PERSEDIAAN BARANG</td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$persediaanrp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr> 
    <?php    
    }
    ?>

<td colspan="2">&nbsp;</td></tr>

<td><b>PIUTANG</b></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'PIUTANG' order by id asc");
    while ($record3=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'PIUTANG' and year(tanggal) like '$thnnow' and nama_akun like '$record3[name]'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga3=$pengunjung->kunjung;
    $a3 = $totalpengunjunga3;
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PIUTANG' and year(tanggal) like '$thnnow' and nama_akun like '$record3[name]'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb3=$pengunjung->kunjung;
    $b3 = $totalpengunjungb3;
    $saldopiutang = $a3 - $b3;
    $saldopiutangrp  = number_format($saldopiutang,2,",",".");
    ?>
    <td><?php echo "$record3[id]"; ?> - <?php echo "$record3[name]"; ?></td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$saldopiutangrp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr> 
    <?php    
    }
    ?>

<td colspan="2">&nbsp;</td></tr>

<td><b>BIAYA BIAYA</b></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'BIAYA BIAYA' group by kategori order by id asc");
    while ($record4=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga4=$pengunjung->kunjung;
    $a4 = $totalpengunjunga4;
    $a4rp  = number_format($a4,2,",",".");
    ?>
    <td><?php echo "$record4[id]"; ?> - Biaya Biaya</td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$a4rp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr> 
    <?php    
    }
    ?>
    </table>
    </td>


    <td width="50%" valign="top" style="border:0px solid #d1d1d1;border-radius:5px;">
    <table width="100%">
<td><b>PASIVA</b></td></tr>

<td colspan="2">&nbsp;</td></tr>

<td><b>HUTANG</b></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'PASIVA' and kategori like 'HUTANG' order by id asc");
    while ($record5=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'HUTANG' and nama_akun like '$record5[name]' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga5=$pengunjung->kunjung;
    $a5 = $totalpengunjunga5;

    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'HUTANG' and nama_akun like '$record5[name]' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb4=$pengunjung->kunjung;
    $b4 = $totalpengunjungb4;
    $saldohutang   = $a5 - $b4;
    $saldohutangrp = number_format($saldohutang,2,",",".");
    ?>
    <td width="70%"><?php echo "$record5[id]"; ?> - <?php echo "$record5[name]"; ?></td>
    <td width="30%">
        <table width="100%">
            <td width="50%"><?php echo "$saldohutangrp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr> 
    <?php    
    }
    ?>

<td colspan="2">&nbsp;</td></tr>

<td><b>EKUITAS</b></td></tr>

    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'PASIVA' and kategori like 'EKUITAS' order by id asc");
    while ($record6=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'EKUITAS' and nama_akun like '$record6[name]' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga10=$pengunjung->kunjung;
    $a10 = $totalpengunjunga10;
    $a10rp  = number_format($a10,2,",",".");
    ?>
    <td width="60%"><?php echo "$record6[id]"; ?> - <?php echo "$record6[name]"; ?></td>
    <td width="40%">
        <table width="100%">
            <td width="50%"><?php echo "$a10rp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr> 
    <?php    
    }
    ?>

    <?php
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PENDAPATAN' and year(tanggal) like '$thnlalu'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga6=$pengunjung->kunjung;
    $a6 = $totalpengunjunga6;
    
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and year(tanggal) like '$thnlalu'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb1=$pengunjung->kunjung;
    $b1 = $totalpengunjungb1;
    $labathnlalu = $a6 - $b1;
    $labathnlalurp  = number_format($labathnlalu,2,",",".");
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PENDAPATAN' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga9=$pengunjung->kunjung;
    $a9 = $totalpengunjunga9;
    
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb2=$pengunjung->kunjung;
    $b2 = $totalpengunjungb2;

    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'HPP' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb21=$pengunjung->kunjung;
    $b21 = $totalpengunjungb21;
    
    $labathnberjalan = $a9 - $b2 - $b21;
    $labathnberjalanrp  = number_format($labathnberjalan,2,",",".");
    ?>
    <td>3201 - LABA TAHUN LALU</td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$labathnlalurp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr>
    
    <td>3301 - LABA TAHUN BERJALAN</td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$labathnberjalanrp"; ?></td>
            <td width="50%">&nbsp;</td>
        </table>
    </td>
    </tr>
    </table>
    </td></tr>
    

<?php
////////////////////////////////////////////////////////////////////////////////////////////
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'KAS' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz1=$pengunjung->kunjung;
    $z1   = $totalpengunjungz1;
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'KAS' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz2=$pengunjung->kunjung;
    $z2   = $totalpengunjungz2;

    $sqlpengunjung="select sum(debet) kunjung from mutasi where jenis_akun like 'AKTIVA' and kategori not like 'KAS' and kategori not like 'BIAYA BIAYA' and kategori not like 'HPP' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz3=$pengunjung->kunjung;
    $z3   = $totalpengunjungz3;
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PIUTANG' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb5=$pengunjung->kunjung;
    $b5 = $totalpengunjungb5;
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'AKTIVA TETAP' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb6=$pengunjung->kunjung;
    $b6 = $totalpengunjungb6;
    
    $totalaktiva = $z1 - $z2 + $z3 - $b5 - $b6;
    $totalaktivarp = number_format($totalaktiva,2,",",".");

////////////////////////////////////////////////////////////////////////////////////////////
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'HUTANG' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz4=$pengunjung->kunjung;
    $z4   = $totalpengunjungz4;
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PENDAPATAN' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz5=$pengunjung->kunjung;
    $z5   = $totalpengunjungz5;

    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz6=$pengunjung->kunjung;
    $z6   = $totalpengunjungz6;
    
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'HUTANG' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz7=$pengunjung->kunjung;
    $z7 = $totalpengunjungz7;

    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'EKUITAS' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungz8=$pengunjung->kunjung;
    $z8 = $totalpengunjungz8;
    
    $totalpasiva = $z4 + $z5 + $z8 + $labathnlalu - $z6 - $z7;
    $totalpasivarp = number_format($totalpasiva,2,",",".");
?>

<td colspan="2"><hr></td></tr>

    <td width="50%" valign="top" style="border:0px solid #d1d1d1;border-radius:5px;">
    <table width="100%">
        <td width="70%"><b>AKTIVA</b></td>
        <td width="15%"><b><?php echo "$totalaktivarp"; ?></b></td>
        <td width="15%">&nbsp;</td>
    </table>
    </td>

    
    <td width="50%" valign="top" style="border:0px solid #d1d1d1;border-radius:5px;">
    <table width="100%">
        <td width="70%"><b>PASIVA</b></td>
        <td width="15%"><b><?php echo "$totalpasivarp"; ?></b></td>
        <td width="15%">&nbsp;</td>
    </table>
    </td>

</table>


<table width="100%" style="margin-top:0px;">
<td height="40">&nbsp;</td></tr>
</table>

</td>
</table>













