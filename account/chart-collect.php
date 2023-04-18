<?php 
include "akses.php";
?>




<script type="text/javascript" src="../link/Chart.js"></script>


<table width="150%" align="center" style="height:330px;margin-left:-10px;margin-top:20px">
    <td align="center" width="30%" style="border:3px solid #cbcbcb;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);">
    <table width="100%" align="center">
    <td valign="top" style="padding:10px;"><canvas id="myChart1" style="width:100%;height:275px;"></canvas></td>
    </table>
    </td>
    
    <td width="1%">&nbsp;</td>
    
    <td align="center" width="30%" style="border:3px solid #cbcbcb;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);">
    <table width="100%" align="center">
    <td valign="top" style="padding:10px;"><?php include "chart-tren-penjualan.php"; ?></td>
    </table>
    </td>

    <td width="1%">&nbsp;</td>

    <td align="center" width="30%" style="border:3px solid #cbcbcb;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);">
    <table width="100%" align="center">
    <td valign="top" style="padding:10px;"><?php include "chart-produk-sale.php"; ?></td>
    </table>
    </td>
</table>

    	<script>
		var ctx = document.getElementById("myChart1").getContext('2d');
		var myChart1 = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: ["Jaguar Pro Motor", "Jaguar Pro Mobil", "Jaguar Pro Industri"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$sqlpengunjung="select sum(jumlah) kunjung from db_order where id_produk like 'PR-698'";
				    $resultpengunjung = mysql_query($sqlpengunjung);
				    $pengunjung=mysql_fetch_object($resultpengunjung);
				    $totalpengunjung1=$pengunjung->kunjung;
				    $qty1 = $totalpengunjung1;
				    echo "$qty1";
					?>, 
					<?php 
					$sqlpengunjung="select sum(jumlah) kunjung from db_order where id_produk like 'PR-486'";
				    $resultpengunjung = mysql_query($sqlpengunjung);
				    $pengunjung=mysql_fetch_object($resultpengunjung);
				    $totalpengunjung2=$pengunjung->kunjung;
				    $qty2 = $totalpengunjung2;
				    echo "$qty2";
					?>,
					<?php 
					$sqlpengunjung="select sum(jumlah) kunjung from db_order where id_produk like 'PR-595'";
				    $resultpengunjung = mysql_query($sqlpengunjung);
				    $pengunjung=mysql_fetch_object($resultpengunjung);
				    $totalpengunjung5=$pengunjung->kunjung;
				    $qty5 = $totalpengunjung5;
				    echo "$qty5";
					?>
					],
					backgroundColor: [
					'#00BFFF','#000000','#ADFF2F',
					'rgba(54, 162, 135, 0.2)'
					],
					borderColor: [
					'black','black','black',
					'rgba(54, 162, 235, 1)'
					],
					borderWidth: 0
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>