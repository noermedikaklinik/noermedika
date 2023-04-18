<?php 
include "akses.php"; 
$bln = date("m");
$thn = date("Y");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>


<table width="67%" >
    <td valign="top">
        <center><span style="font-size:12px;font-family:verdana;">Tren Penjualan Produk</span></center>
<figure class="highcharts-figure">
  <div id="container" style="height:220px;"></div>
</figure>
   </td>
   </table>


<script>
Highcharts.chart('container', {

    title: {
        text: ''
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: 'Total Penjualan'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 0'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart:0
        }
    },

    series: [{
        name: 'Jaguar Pro Motor',
        data: 
        [
        <?php
        $query=mysql_query("SELECT * FROM db_order where id_produk like 'PR-698' and year(tanggal)='$thn' and month(tanggal)='$bln' order by no asc limit 30");
        while ($record1=mysql_fetch_array($query)){
        $sqlpengunjung    = "select sum(jumlah) kunjung from db_order where id_produk like '$record1[id_produk]' and tanggal like '$record1[tanggal]'";
        $resultpengunjung = mysql_query($sqlpengunjung);
        $pengunjung1      = mysql_fetch_object($resultpengunjung);
        $jml_1            = $pengunjung1->kunjung;
        echo "$jml_1,";
        }
        ?>
        ]
    }, {
        name: 'Jaguar Pro Mobil',
        data: 
        [
        <?php
        $query=mysql_query("SELECT * FROM db_order where id_produk like 'PR-486' and year(tanggal)='$thn' and month(tanggal)='$bln' order by no asc limit 30");
        while ($record2=mysql_fetch_array($query)){
        $sqlpengunjung    = "select sum(jumlah) kunjung from db_order where id_produk like '$record2[id_produk]' and tanggal like '$record2[tanggal]'";
        $resultpengunjung = mysql_query($sqlpengunjung);
        $pengunjung2      = mysql_fetch_object($resultpengunjung);
        $jml_2            = $pengunjung2->kunjung;
        echo "$jml_2,";
        }
        ?>
        ]
    }, {
        name: 'Jaguar Pro Industri',
        data: 
        [
        <?php
        $query=mysql_query("SELECT * FROM db_order where id_produk like 'PR-595' and year(tanggal)='$thn' and month(tanggal)='$bln' order by no asc limit 30");
        while ($record3=mysql_fetch_array($query)){
        $sqlpengunjung    = "select sum(jumlah) kunjung from db_order where id_produk like '$record3[id_produk]' and tanggal like '$record3[tanggal]'";
        $resultpengunjung = mysql_query($sqlpengunjung);
        $pengunjung3      = mysql_fetch_object($resultpengunjung);
        $jml_3            = $pengunjung3->kunjung;
        echo "$jml_3,";
        }
        ?>
        ]
    }
    ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>





