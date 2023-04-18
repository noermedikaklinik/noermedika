<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', 'logs/error.log');

include "akses.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.highcharts.com/highcharts.src.js" type="text/javascript"></script>



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
               text: 'Total Penjualan Global'
            }
         },
              series:             
            [
            <?php 
        	$conn=mysqli_connect('localhost','u7790585_anggie','abnys2519');
        	mysqli_select_db($conn,'u7790585_jaguarpro');
            $sql   = "SELECT *  FROM db_order group by tanggal order by tanggal asc limit 10";
            $query = mysqli_query( $conn,$sql )  or die(mysqli_error());
            while( $ret = mysqli_fetch_array( $query ) ){

            $sqlpengunjung    = "select sum(jumlah) kunjung from db_order where tanggal like '$ret[tanggal]'";
            $resultpengunjung = mysql_query($sqlpengunjung);
            $pengunjung1      = mysql_fetch_object($resultpengunjung);
            $a                = $pengunjung1->kunjung;
            ?>
                  {
                      name: '<span style="font-size:8px;"><?php echo "$ret[tanggal]"; ?></span>',
                      data: [<?php echo "$a"; ?>],
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
<center><span style="font-size:12px;font-family:verdana;">Performance Penjualan Global (COVER PACK)</span></center>
<div id='container1' style="width:100%;height:250px;margin-top:10px;"></div></td>







