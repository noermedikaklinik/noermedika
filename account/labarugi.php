<?php 
require_once "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php";

$thnnow  = date("Y");
$thnnow2 = date("Y"); 
$thnlalu = $thnnow - 1; 
$blnnow = date("M");
$tglnow = date("d-M-Y");
$jamnow = date("H:i");
?>

<div style="height:100px;"></div>

<table width="95%" align="center">

<?php include "dash-left-keuangan.php"; ?>

<td style="width:1%;"></td>

<td valign="top" style="width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="90%" style="margin-top:30px;">
<td><font size="3"><b>APOTEK NOER MEDIKA</b></font></td></tr>
<td><font size="3">LABA RUGI</font></td></tr>
<td><font size="2">Periode 01-Jan-<?php echo "$thnnow"; ?> s/d 31-<?php echo "$blnnow"; ?>-<?php echo "$thnnow2"; ?></font></td></tr>
<td height="20"><hr></td></tr>
</table>

<table width="90%" style="margin-top:0px;padding:10px;">
    <td width="80%" valign="top" style="border:0px solid #d1d1d1;border-radius:5px;">
    <table width="100%">
    <td width="70%"><u><b>PENDAPATAN</b></u></td> <td><u><b>Tahun : <?php echo "$thnnow"; ?></b></u></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'PENDAPATAN' order by id asc");
    while ($record1=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PENDAPATAN' and nama_akun like '$record1[name]' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga1=$pengunjung->kunjung;
    $a1 = $totalpengunjunga1;
    $a1rp = number_format($a1,2,",",".");
    ?>
    <td><?php echo "$record1[id]"; ?> - <?php echo "$record1[name]"; ?></td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$a1rp"; ?></td>
        </table>
    </td>
    </tr>
    <?php    
    }
    ?>

<td height="20" colspan="2">&nbsp;</td></tr>

<td width="70%"><u><b>BIAYA BIAYA</b></u></td> <td><u><b>Tahun : <?php echo "$thnnow"; ?></b></u></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'BIAYA BIAYA' and name not like 'HARGA POKOK PENJUALAN' order by id asc");
    while ($record2=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and nama_akun like '$record2[name]' and year(tanggal) like '$thnnow' ";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga2=$pengunjung->kunjung;
    $a2 = $totalpengunjunga2;
    
    $a2rp = number_format($a2,2,",",".");
    ?>
    <td><?php echo "$record2[id]"; ?> - <?php echo "$record2[name]"; ?></td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$a2rp"; ?></td>
        </table>
    </td>
    </tr>
    <?php    
    }
    ?>
    
<td height="20" colspan="2">&nbsp;</td></tr>

<td width="70%"><u><b>HARGA POKOK</b></u></td> <td><u><b>Tahun : <?php echo "$thnnow"; ?></b></u></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'HPP' order by id asc");
    while ($record13=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'HPP' and nama_akun like '$record13[name]' and year(tanggal) like '$thnnow' ";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga13=$pengunjung->kunjung;
    $a13 = $totalpengunjunga13;
    
    $a13rp = number_format($a13,2,",",".");
    ?>
    <td><?php echo "$record13[id]"; ?> - <?php echo "$record13[name]"; ?></td>
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$a13rp"; ?></td>
        </table>
    </td>
    </tr>
    <?php    
    }
    ?>
</table>
</td>





<td width="20%" valign="top" style="border:0px solid #d1d1d1;border-radius:5px;">
    <table width="100%">
    <td width="40%"><u><b>Tahun : <?php echo "$thnlalu"; ?></b></u></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'PENDAPATAN' order by id asc");
    while ($record1=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PENDAPATAN' and nama_akun like '$record1[name]' and year(tanggal) like '$thnlalu'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga1=$pengunjung->kunjung;
    $a1 = $totalpengunjunga1;
    
    $a1rp = number_format($a1,2,",",".");
    ?>
    
    <td>
        <table width="100%">
            <td width="50%"><?php echo "$a1rp"; ?></td>
        </table>
    </td>
    </tr>
    <?php    
    }
    ?>

<td height="20" colspan="2">&nbsp;</td></tr>

<td width="60%"><u><b>Tahun : <?php echo "$thnlalu"; ?></b></u></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'BIAYA BIAYA' order by id asc");
    while ($record2=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and nama_akun like '$record2[name]' and year(tanggal) like '$thnlalu'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga2=$pengunjung->kunjung;
    $a2 = $totalpengunjunga2;
    
    $a2rp = number_format($a2,2,",",".");
    ?>

    <td>
        <table width="100%">
            <td width="50%"><?php echo "$a2rp"; ?></td>
        </table>
    </td>
    </tr>
    <?php    
    }
    ?>

<td height="20" colspan="2">&nbsp;</td></tr>

<td width="60%"><u><b>Tahun : <?php echo "$thnlalu"; ?></b></u></td></tr>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where jenis_akun like 'AKTIVA' and kategori like 'HPP' order by id asc");
    while ($record13=mysqli_fetch_array($qry)) {
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'HPP' and nama_akun like '$record13[name]' and year(tanggal) like '$thnlalu' ";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga13=$pengunjung->kunjung;
    $a13 = $totalpengunjunga13;
    ?>

    <td>
        <table width="100%">
            <td width="50%"><?php echo "$a2rp"; ?></td>
        </table>
    </td>
    </tr>
    <?php    
    }
    ?>
</table>
</td></tr>

<td height="20" colspan="2"><hr></td></tr>
</table>

<?php
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PENDAPATAN'  and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga3=$pengunjung->kunjung;
    $a3 = $totalpengunjunga3;

    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb3=$pengunjung->kunjung;
    $b3 = $totalpengunjungb3;

    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'HPP' and year(tanggal) like '$thnnow'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb6=$pengunjung->kunjung;
    $b6 = $totalpengunjungb6;
    $lababersihskrg = $a3 - $b3 - $b6;
    $lababersihskrgrp = number_format($lababersihskrg,2,",",".");
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where kategori like 'PENDAPATAN'  and year(tanggal) like '$thnlalu' ";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjunga4=$pengunjung->kunjung;
    $a4 = $totalpengunjunga4;

    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'BIAYA BIAYA' and year(tanggal) like '$thnlalu'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb4=$pengunjung->kunjung;
    $b4 = $totalpengunjungb4;
    
    $sqlpengunjung="select sum(debet) kunjung from mutasi where kategori like 'HPP' and year(tanggal) like '$thnlalu'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjungb5=$pengunjung->kunjung;
    $b5 = $totalpengunjungb5;
    $lababersihlalu = $a4 - $b4 - $b5;
    $lababersihlalurp = number_format($lababersihlalu,2,",",".");

?>

<table width="90%" align="center" style="margin-top:0px;">
<td width="55%" height="30" align="right" style="margin-top:0px;border:0px solid grey;border-radius:5px;"><b>Laba Bersih : &nbsp;</b></td> 
<td width="25%" height="30" style="margin-top:0px;border:0px solid grey;border-radius:5px;"> &nbsp; <b><?php echo "$lababersihskrgrp"; ?></b></td> 
<td width="20%"  height="30" style="margin-top:0px;border:0px solid grey;border-radius:5px;"> &nbsp; <b><?php echo "$lababersihlalurp"; ?></b></td></tr>
</table>



<table width="100%" style="margin-top:0px;">
<td height="70">&nbsp;</td></tr>
</table>















