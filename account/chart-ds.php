<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', 'logs/error.log');

include "akses.php";
$thn = substr($tgl1,0,4);
$bln = substr($tgl1,5,2);
if($thn == "" and $bln == ""){$thn1 = date("Y");$bln1 = date("m");}
if($thn <> "" and $bln <> ""){$thn1 = $thn; $bln1 = $bln;}

$result1 = mysqli_query($link, "SELECT * FROM db_produk where id_produk like '$produk_cari'");
$produk3  = mysqli_fetch_assoc($result1);

if ($produk3[nama] == ""){$nama_produk = $produk_cari;}
if ($produk3[nama] <> ""){$nama_produk = $produk3[nama];}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.highcharts.com/highcharts.src.js" type="text/javascript"></script>

<table align="center" width="100%" style="margin-top:20px;">
<td align="center" style="width:100%;border:0px solid grey;"><br>
<table width="100%" align="center">
    
    <td align="center" valign="top" style="font-size:16px;">Sales Performance Chart <?php echo "Periode : $thn1-$bln1 | Produk : $nama_produk"; ?>
    <br>
    <script type="text/javascript">
	var chart1; 
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container1',
            type: 'column'
         },   
         title: {
            text: ''
         },
         xAxis: {
            categories: ['']
         },
         yAxis: {
            title: {
               text: 'Total Penjualan Direct Selling'
            }
         },
              series:             
            [
            <?php 
        	$conn=mysqli_connect('localhost','u7790585_anggie','abnys2519');
        	mysqli_select_db($conn,'u7790585_jaguarpro');
            $sql   = "SELECT *  FROM db_order where year(tanggal)='$thn1' and month(tanggal)='$bln1' and id_sales like '$id_user' $filter_produk group by tanggal";
            $query = mysqli_query( $conn,$sql )  or die(mysqli_error());
            while( $ret = mysqli_fetch_array( $query ) ){

            $sqlpengunjung    = "select sum(jumlah) kunjung from db_order where id_sales like '$ret[id_sales]' and tanggal like '$ret[tanggal]'";
            $resultpengunjung = mysql_query($sqlpengunjung);
            $pengunjung1      = mysql_fetch_object($resultpengunjung);
            $a                = $pengunjung1->kunjung;
            
            $result1   = mysqli_query($link, "SELECT * FROM db_sales where id_user like '$ret[id_sales]'");
            $sales     = mysqli_fetch_assoc($result1);
            ?>
                  {
                      name: '<?php echo "$ret[tanggal]"; ?>',
                      data: [<?php echo "$a"; ?>],
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
		<div id='container1' style="width:100%;"></div></td>

</td>
</table>
</td>
</table>





