<?php 
require "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php"; 

$sql     = mysqli_query($koneksi, "SELECT max(id) as maximal FROM list_akun") or die (mysqli_error());
$res     = mysqli_fetch_array($sql);
$id_akun = $res['maximal'] + 1;

$tglnow = date("d-M-Y");
$jamnow = date("H:i");
?>

<script>
$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Submitting...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Submit');

}, 10000);
});
});
</script>

<div style="height:100px;"></div>


<FORM language="javascript" name="form1" method="post" action="action/add-coa" onSubmit="return cek()">
<input name="jenis" type="hidden" value="new-coa">

<table width="95%" align="center">
<td valign="top" style="width:30%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
    <table align="center" style="width:85%;">
        <td colspan="2" align="center"><img src="staff-image/<?php echo "$akses[foto]"; ?>" style="width:50%;height:190px;margin-top:35px;border-radius:10px;"></td></tr>
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:grey;"></td></tr>
        <td style="width:25%;">ID Karyawan</td>
        <td style="width:75%;">: <?php echo "$akses[id_user]"; ?></td></tr>
        <td style="width:25%;">Nama</td>
        <td style="width:75%;">: <?php echo "$akses[nama]"; ?></td></tr>
        <td style="width:25%;">Tanggal</td>
        <td style="width:75%;">: <?php echo "$tglnow"; ?></td></tr>
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:grey;"></td></tr>
        <td colspan="2" align="center"><?php include "jam.php"; ?></td></tr>
        <td colspan="2" align="center" height="30">&nbsp;</td></tr>
        <td colspan="2">
            <script>
            function absensi_karyawan(bookURL){window.open(bookURL,"bookDetails","width=750,height=550,top=100px,left=400px,left=400px;");}
            function lap_kasir(bookURL){window.open(bookURL,"bookDetails","width=950,height=650,top=50px,left=300px,left=300px;");}
            </script>
            <table style="width:100%;padding:10px;margin-top:0px;">
                <td align="center" style="width:33%;" onclick="return absensi_karyawan('snapshot')"><a tooltip='Absensi Karyawan' flow='right'><i class="fa fa-clock-o" style="color:orange;font-size:27px;"></i></a><br>Absensi</td>
                <td align="center" style="width:33%;" onclick="return lap_kasir('lap-kasir')"><a tooltip='Laporan Kasir' flow='left'><i class="fa fa-dollar" style="color:purple;font-size:27px;"></i></a><br>Lap Kasir</td>
                <td align="center" style="width:33%;"><a href="keuangan" tooltip='Jurnal Umum' flow='left'><i class="fa fa-exchange" style="color:red;font-size:27px;"></i></a><br>Jurnal Umum</td></tr>
                <td colspan="3" height="30">&nbsp;</td></tr>
                <td align="center" style="width:33%;"><a href="labarugi" tooltip='Laba Rugi' flow='left'><i class="fa fa-line-chart" style="color:green;font-size:27px;"></i></a><br>Laba Rugi</td>
                <td align="center" style="width:33%;"><a href="neraca" tooltip='Neraca Usaha' flow='left'><i class="fa fa-balance-scale" style="color:brown;font-size:27px;"></i></a><br>Neraca</td>
                <td align="center" style="width:33%;"><a tooltip='Laporan Absensi Karyawan' flow='right'><i class="fa fa-calendar" style="color:blue;font-size:27px;"></i></a><br>Lap Absensi</td>
            </table>
        </td></tr>
    </table>
</td>

<td style="width:1%;"></td>

<td valign="top" style="height:600px;width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="90%">
    <td height="40">&nbsp;</td></tr>
    <td height="20"><a href="keuangan" tooltip='Kembali ke dashboard' flow='left'><i class="fa fa-arrow-left" style="color:grey;font-size:22px;"></i></a> &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Akun COA</b></font><hr style="border:0px;height:2px;background:#d1d1d1;"></td></tr>
</table>

<table width="90%">
<td align="left" valign="top">
<table width="100%" align="left">
    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="15%"><b>Kategori Akun</b></td>
    <td width="85%"><select name="kategori" id="kategori" required>
    <option value="" selected>- Pilih Kategori Akun -</option>
    <option value="BIAYA BIAYA">BIAYA BIAYA</option>
    <option value="EKUITAS">EKUITAS</option>
    <option value="HUTANG">HUTANG</option>
    <option value="KAS">KAS</option>
    <option value="PERSEDIAAN">PERSEDIAAN</option>
    <option value="PENDAPATAN">PENDAPATAN</option>
    <option value="PIUTANG">PIUTANG</option>
    </select>
    </td></tr>
    
    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="15%"><b>Nama Akun</b></td>
    <td width="85%"><input type="text" id="listakun" name="nama" list="branch-list2" autocomplete="off" required>
    <datalist id="branch-list2">
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun where id not like '1003' group by name order by id asc");
    while ($t=mysqli_fetch_array($qry)) {
    echo "<option value='$t[name]'>$t[id] - $t[name] - $t[kategori] - $t[jenis_akun]</option>";
    }
    ?>
    </datalist>
    </td></tr>

    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="15%"><b>Kode Akun</b></td>
    <td width="85%"><input name="id_akun" type="number"></td></tr>
    </table>
</td></tr>


    <td colspan="2">
    <table width="100%" align="center">
    <td colspan="2" height="80"><hr style="border:0px;height:2px;background:#d1d1d1;"></td></tr>
    <td colspan="2" align="right" height="60"><button>Submit</button></form></td></tr>
    <td colspan="2" height="30">&nbsp;</td></tr>
    </table>
    </td>
</table>

</td>
</table>




