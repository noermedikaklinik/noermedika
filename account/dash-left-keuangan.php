<td valign="top" style="width:30%;">
    <table align="center" style="height:530px;width:100%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
      <td><table style="width:90%;">
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:grey;"></td></tr>
        <td style="width:25%;">ID Karyawan</td>
        <td style="width:75%;">: <?php echo "$akses[no]"; ?></td></tr>
        <td style="width:25%;">Nama</td>
        <td style="width:75%;">: <?php echo "$akses[nama]"; ?></td></tr>
        <td style="width:25%;">Posisi</td>
        <td style="width:75%;">: <?php echo "$akses[hak_akses]"; ?></td></tr>
        <td style="width:25%;">Tanggal</td>
        <td style="width:75%;">: <?php echo "$tglnow"; ?></td></tr>
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:grey;"></td></tr>
        <td colspan="2" align="center"><?php include "jam.php"; ?></td></tr>
        <td colspan="2" align="center" height="30">&nbsp;</td></tr>
        <td colspan="2">
            <script>
            function absensi_karyawan(bookURL){window.open(bookURL,"bookDetails","width=750,height=550,top=100px,left=400px,left=400px;");}
            function lap_kasir(bookURL){window.open(bookURL,"bookDetails","width=950,height=650,top=50px,left=300px,left=300px;");}
            function lap_absensi(bookURL){window.open(bookURL,"bookDetails","width=950,height=650,top=50px,left=300px,left=300px;");}
            </script>
            <table style="width:100%;padding:10px;margin-top:0px;">
                <td align="center" style="width:33%;" onclick="return absensi_karyawan('snapshot')"><a tooltip='Absensi Karyawan' flow='right'><i class="fa fa-clock-o" style="color:orange;font-size:27px;"></i></a><br>Absensi</td>
                <td align="center" style="width:33%;" onclick="return lap_kasir('lap-kasir')"><a tooltip='Laporan Kasir' flow='left'><i class="fa fa-dollar" style="color:purple;font-size:27px;"></i></a><br>Lap Kasir</td>
                <td align="center" style="width:33%;"><a href="keuangan" tooltip='Jurnal Umum' flow='left'><i class="fa fa-exchange" style="color:red;font-size:27px;"></i></a><br>Jurnal Umum</td></tr>
                <td colspan="3" height="30">&nbsp;</td></tr>
                <td align="center" style="width:33%;"><a href="labarugi" tooltip='Laba Rugi' flow='left'><i class="fa fa-line-chart" style="color:green;font-size:27px;"></i></a><br>Laba Rugi</td>
                <td align="center" style="width:33%;"><a href="neraca" tooltip='Neraca Usaha' flow='left'><i class="fa fa-balance-scale" style="color:brown;font-size:27px;"></i></a><br>Neraca</td>
                <td align="center" style="width:33%;" onclick="return lap_absensi('lap-absensi')"><a tooltip='Laporan Absensi Karyawan' flow='right'><i class="fa fa-calendar" style="color:blue;font-size:27px;"></i></a><br>Lap Absensi</td>
            </table>
        </td></tr>
    </table>
    </td></table>
</td>