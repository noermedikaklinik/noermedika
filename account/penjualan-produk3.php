<?php
require "akses.php";
if (
    $akses['jabatan'] <> "KASIR" && 
    $akses['jabatan'] <> "APOTEKER" && 
    $akses['jabatan'] <> "ASISTEN APOTEKER")
{
    header ("Location:./");
}
include "mainhead.php";

$nota      = $_GET['nota'];
$result1   = mysqli_query($koneksi, "SELECT * FROM db_penjualan where nota like '$nota' order by urut desc");
$trx       = mysqli_fetch_assoc($result1);

if ($trx['jenis_pembayaran'] == "CASH") {$tipe = "Pembayaran Tunai";}
if ($trx['jenis_pembayaran'] == "DEBIT"){$tipe = "Pembayaran Debit";}

$cash_terimarp      = number_format($trx["cash_terima"],0,",",".");
$cash_returnrp      = number_format($trx["cash_return"],0,",",".");

$tglnow = date("d-M-Y");
$jamnow = date("H:i");
?>


<div style="height:100px;"></div>
<form method="post" action="penjualan-produk2" enctype="multipart/form-data">
<input type="hidden" name="nota" value="<?php echo "$nota2"; ?>">
<input type="hidden" name="urut" value="<?php echo "$urut1"; ?>">
    
<table width="95%" align="center">

    <?php include "dash-left-staff.php"; ?>

    <td style="width:1%;"></td>

    <td style="width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
        <table width="95%" align="center">
            <td width="100%" style="padding:10px;"><font size="3" color="#5b8ff5"><b>Nota Penjualan : <?php echo "$nota"; ?></b></font></td>  
        </table>

        <table width="95%" align="center">
            <tr>
                <td style="width:100%;padding:10px;">
                    <iframe src="frame-transaksi-penjualan2.php?nota=<?php echo "$nota"; ?>" style="width:100%;height:330px;border:2px solid #d1d1d1;" scrolling="yes"></iframe>
                </td>
            </tr>
        </table>
        <?php
            $sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where nota like '$nota' and id_user like '$akses[id_user]'";
            $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
            $pengunjung3      = mysqli_fetch_object($resultpengunjung);
            $grand_total      = $pengunjung3->kunjung;
            $grand_totalrp    = number_format($grand_total,0,",",".");
        ?>
        <table width="95%" align="center">
            <tr width="93%" align="center" style="padding:10px;">
                <td align="right" style="width:80%;font-weight:bold;">Grand Total :</td>
                <td align="right" style="width:20%;font-weight:bold;"> &nbsp; Rp. <?php echo "$grand_totalrp"; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="right" style="width:100%;font-weight:bold;"><hr style="border:0px;height:1px;background:grey;"></td>
            </tr>
            <tr>
                <td align="right" style="width:80%;font-weight:bold;"><?php echo "$tipe"; ?> :</td>
                <td align="right" style="width:20%;font-weight:bold;"> &nbsp; Rp. <?php echo "$cash_terimarp"; ?></td>
            </tr>
            <tr>
                <td align="right" style="width:80%;font-weight:bold;">Kembali :</td>
                <td align="right" style="width:20%;font-weight:bold;"> &nbsp; Rp. <?php echo "$cash_returnrp"; ?></td>
            </tr>
            <tr>        
                <td colspan="2" align="right" style="width:100%;font-weight:bold;"><hr style="border:0px;height:1px;background:grey;"></td></tr>
            </tr>
        </table>

    

    <div style="height:25px;"></div>

    </td>
</table>


<div style="height:25px;"></div>
















