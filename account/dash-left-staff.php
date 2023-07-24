<td valign="top">
    <table class="custom-card">
        <td style="padding:20px;"><table width="100%">
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:#d1d1d1;"></td></tr>
        <td style="width:25%;">ID Karyawan</td>
        <td style="width:75%;">: <?php echo "$akses[id_user]"; ?></td></tr>
        <td style="width:25%;">Nama</td>
        <td style="width:75%;">: <?php echo "$akses[nama]"; ?></td></tr>
        <td style="width:25%;">Posisi</td>
        <td style="width:75%;">: <?php echo "$akses[hak_akses]"; ?></td></tr>
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:#d1d1d1;"></td></tr>
        <td colspan="2">
            <script>
            function lap_penjualan_produk(bookURL){window.open(bookURL,"bookDetails","width=650,height=750,top=100px,left=400px,left=400px;");}
            </script>
            <table style="width:100%;padding:10px;margin-top:20px;">
                
                <td align="center" style="width:25%;padding:10px;" onclick="return lap_penjualan_produk('lap-penjualan-produk')">
                    <a tooltip='Laporan Penjualan' flow='left' disabled><i class="fa fa-print" style="color:purple;font-size:27px;"></i></a>
                    <br>Slip Setor
                </td>
            </table>
        </td></tr>
    </table>
    </td></table>
</td>