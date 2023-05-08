<?php 
include "akses.php";
if ($akses["hak_akses"] <> "KEUANGAN" and $akses['hak_akses'] <> 'ADMIN'){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}
include "mainhead.php"; 

$jurnalno = isset($_GET['jurnalno'])?$_GET['jurnalno']:"";
if ($jurnalno == ""){
    $kode = rand(6,999999); 
    $jurnalno2 = "GL-$kode";
    $jurnalno = "GL-$kode";
}else{
    $jurnalno2 = $jurnalno;
}
$sql1    = mysqli_query($koneksi, "SELECT * FROM mutasi where jurnalno like '$jurnalno'") or die (mysql_error());
$jurnal  = mysqli_fetch_array($sql1);

$tglnow = date("d-M-Y");
$jamnow = date("H:i");
?>


<script language="javascript">
var htmlobjek;
$(document).ready(function(){
  $("#kategori").change(function(){
    var kategori = $("#kategori").val();
    $.ajax({
        url: "take_akun.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            $("#id_akun").html(msg);
        }
    });
  });
});
</script>

<table class ="table-main">

<?php include "dash-left-keuangan.php"; ?>

<td style="width:1%;"></td>

<td valign="top" style="width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="90%" style="margin-top:30px;">
    <td width="80%"><font size="4" color="#5b8ff5"><b>Jurnal Harian</b></font></td>
    <td width="10%" align="center"><a href="add-coa" tooltip='Tambahkan COA baru' flow='left'><i class="fa fa-plus" style="color:green;font-size:22px;"></i></a><br>COA</td>
    <td width="10%" align="center"><a href="lap-jurnal" tooltip='Jurnal Umum' flow='left'><i class="fa fa-file-text-o" style="color:green;font-size:22px;"></i></a><br>Laporan</td></tr>
    <td colspan="2"><hr></td></tr>
</table>

<FORM language="javascript" name="form1" method="post" action="action/add-jurnal" onSubmit="return cek()">
    
<input name="jenis" type="hidden" value="add-jurnal">
<input name="jurnalno" type="hidden" value="<?php echo "$jurnalno2"; ?>">

<table width="90%">
<td width="50%" align="center" valign="top">
<table width="100%" align="center" style="padding:10px;">
    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="25%"><b>Tanggal Transaksi</b><br>
    <input name="trx_date" type="date" value="<?php echo"$jurnal[tanggal]"; ?>" autocomplete="off" style="width:95%;" required></td></tr>

    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="25%"><b>Kategori Akun</b><br>
    <select name="kategori" id="kategori" style="width:95%;" required>
    <option value="" selected>- Pilih Kategori -</option>
    <?php 
    $qry=mysqli_query($koneksi, "SELECT * From list_akun group by kategori order by kategori");
    while ($a=mysqli_fetch_array($qry)) {
    echo "<option value='$a[kategori]'>$a[kategori]</option>";
    }
    ?>
    </select></td></tr>
    
    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="25%"><b>Nama Akun</b><br>
    <select name="id_akun" id="id_akun" style="width:95%;" required>
    </select></td></tr>
</table>
</td>

<td widht="50%" align="center" valign="top">
<table width="100%" align="left">
    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="25%"><b>Nomor Transaksi</b><br>
    <input name="trx_no" type="text" value="" autocomplete="off" required></td></tr>

    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="25%"><b>Nominal Transaksi</b><br>
    <input name="amount" type="text" id="tanparupiah1" autocomplete="off" required></td></tr>

    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="25%"><b>Keterangan</b><br>
    <input name="desk" type="text" value="" autocomplete="off" required></td></tr>

    <td colspan="2" height="10">&nbsp;</td></tr>
    <td width="25%"><b>Jenis Transaksi</b><br>
    <select name="tipe" required>
    <option value="" selected>- Pilih Jenis -</option>
    <option value="DEBET">DEBET</option>
    <option value="KREDIT">KREDIT</option>
    </select></td></tr>
</table>
</td></tr>

<td colspan="2">
    <table width="100%" align="center">
    <td colspan="2" height="60"><hr style="border:0px;height:2px;background:#d1d1d1;"></td></tr>
    <td colspan="2" align="right" height="60"><button>Insert</button></form></td></tr>
    <td colspan="2" height="30">&nbsp;</td></tr>
    </table>
</td>
</table>


<table width="90%" align="center">
<tr bgcolor="#CECECE" height="35">
<td width="10%" align="center" style="padding:10px;"><font color="black" face="verdana" size="2">Tanggal</font></td>
<td width="10%" align="center" style="padding:10px;"><font color="black" face="verdana" size="2">No Transaksi</font></td>
<td width="20%" align="left" style="padding:10px;"><font color="black" face="verdana" size="2">Nama Akun</font></td>
<td width="15%" align="right" style="padding:10px;"><font color="black" face="verdana" size="2">Nominal</font></td>
<td width="10%" align="center" style="padding:10px;"><font color="black" face="verdana" size="2">Jenis</font></td>
<td width="5%" align="center" style="padding:10px;"><font color="black" face="verdana" size="2">Batal</font></td>
</tr>

<?php
$jurnalno = is_null($jurnal)?"":$jurnal["jurnalno"];
$sql = "SELECT * FROM mutasi where jurnalno like '$jurnalno' and report like '0'";
$qry = mysqli_query($koneksi, $sql) or die ("Query Gagal ".mysql_error());
while($res=mysqli_fetch_array($qry)){

$sql  = mysqli_query($koneksi, "SELECT * FROM list_akun where name like '$res[nama_akun]'") or die (mysql_error());
$akun = mysqli_fetch_assoc($sql);
    
if ($res["tipe"] == "DEBET") {$trx_value = $res["debet"];}
if ($res["tipe"] == "KREDIT"){$trx_value = $res["kredit"];}

$trx_valuerp = number_format($trx_value,0,",",".");
?>

<script type='text/javascript' language='JavaScript'>
    function cekdelete()
    {
    tanya = confirm('Anda Yakin Membatalkan Jurnal ?');
    if (tanya == true) return true;
    else return false;
    }
</script>

<td align="center" style="padding:10px;"><?php echo "$res[tanggal]"; ?></td>
<td align="center" style="padding:10px;"><?php echo "$res[trx_no]"; ?></td>
<td style="padding:10px;"><?php echo "$akun[id]"; ?> - <?php echo "$res[nama_akun]"; ?></td>
<td align="right" style="padding:10px;">Rp. <?php echo "$trx_valuerp"; ?></td>
<td align="center" style="padding:10px;"><?php echo "$res[tipe]"; ?></td>
<td align="center" style="padding:10px;"><a href="save-data?no=<?php echo "$res[no]"; ?>&jenis2=del-jurnal&jurnalno=<?php echo "$res[jurnalno]"; ?>" tooltip="Batalkan Jurnal" flow="left" onclick="return cekdelete()"><i class="fa fa-trash" style="color:red;font-size:16px;margin-left:0px;"></i></a></td>
</tr>

<?php 
} 
    $sqlpengunjung="select sum(debet) kunjung from mutasi where jurnalno like '$jurnalno' and report like '0'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjung1=$pengunjung->kunjung;
    $a1 = $totalpengunjung1;
    $a1rp   = number_format($a1,2,",",".");
    
    $sqlpengunjung="select sum(kredit) kunjung from mutasi where jurnalno like '$jurnalno' and report like '0'";
    $resultpengunjung = mysqli_query($koneksi, $sqlpengunjung);
    $pengunjung=mysqli_fetch_object($resultpengunjung);
    $totalpengunjung2=$pengunjung->kunjung;
    $a2 = $totalpengunjung2;
    $a2rp   = number_format($a2,2,",",".");
    
    $oob = $a1 - $a2;
    $oobrp   = number_format($oob,2,",",".");

?>
<td colspan="7"><hr style="border:0px;height:2px;background:#d1d1d1;"></td></tr>
</table>

<script language="javascript">
function cekbalance() 
{
if(document.form2.saldo.value > '0') { alert('Jurnal Tidak Balance');return false;} 
}
</script>

<FORM language="javascript" name="form2" method="post" action="action/confirm-jurnal" onSubmit="return cekbalance();">
<input name="jenis" type="hidden" value="confirm-jurnal">
<input name="jurnalno" type="hidden" value="<?php echo "$jurnal[jurnalno]"; ?>">
<input name="saldo" type="hidden" value="<?php echo "$oob"; ?>">

<table width="90%" style="margin-top:0px;">
    <td height="20" width="100">Total Debet</td>    <td>: Rp. <?php echo "$a1rp"; ?></td></tr>
    <td height="20" width="100">Total Kredit</td>   <td>: Rp. <?php echo "$a2rp"; ?></td></tr>
    <td height="20" width="100">Balance</td>        <td>: Rp. <?php echo "$oobrp"; ?></td></tr>
</table>


<table width="90%" align="center">
    <td colspan="2" height="60"><hr style="border:0px;height:2px;background:#d1d1d1;"></td></tr>
    <td colspan="2" align="right" height="60"><button>Confirmed</button></form></td></tr>
    <td colspan="2" height="30">&nbsp;</td></tr>
</table>

</td>
</table>

</td>
</table>

<div style="height:50px;"></div>

<script>
 /* Tanpa Rupiah */
 var tanparupiah1 = document.getElementById('tanparupiah1');
 tanparupiah1.addEventListener('keyup', function(e)
 {
  tanparupiah1.value = formatRupiah(this.value);
 });
 
 /* Fungsi */
 function formatRupiah(angka, prefix)
 {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
   split = number_string.split(','),
   sisa  = split[0].length % 3,
   rupiah  = split[0].substr(0, sisa),
   ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
   
  if (ribuan) {
   separator = sisa ? '.' : '';
   rupiah += separator + ribuan.join('.');
  }
  
  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
 }
</script>

<script src="../link/myjs.js"></script>














