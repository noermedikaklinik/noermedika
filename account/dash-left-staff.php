<td valign="top" style="width:30%;height:600px;padding:0px;">
    <table align="center" style="width:100%;height:100px;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
        <td style="padding:20px;"><table width="100%">
        <td colspan="2" align="center"><img src="staff-image/<?php echo "$akses[foto]"; ?>" style="width:30%;height:auto;margin-top:15px;border-radius:100%;"></td></tr>
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:#d1d1d1;"></td></tr>
        <td style="width:25%;">ID Karyawan</td>
        <td style="width:75%;">: <?php echo "$akses[id_user]"; ?></td></tr>
        <td style="width:25%;">Nama</td>
        <td style="width:75%;">: <?php echo "$akses[nama]"; ?></td></tr>
        <td style="width:25%;">Posisi</td>
        <td style="width:75%;">: <?php echo "$akses[jabatan]"; ?></td></tr>
        <td style="width:25%;">Tanggal / Jam</td>
        <td style="width:75%;">: <?php echo "$tglnow $jamnow"; ?></td></tr>
        <td style="width:25%;">Total Trx</td>
        <td style="width:75%;">: Rp. <?php echo "$user_trxrp"; ?></td></tr>
        <td colspan="2" align="center"><hr style="border:0px;height:1px;background:#d1d1d1;"></td></tr>
        <td colspan="2" align="center"><?php include "jam.php"; ?></td></tr>
        <td colspan="2">
            <script>
            function absensi_karyawan(bookURL){window.open(bookURL,"bookDetails","width=750,height=550,top=100px,left=400px,left=400px;");}
            function lap_penjualan_produk(bookURL){window.open(bookURL,"bookDetails","width=650,height=750,top=100px,left=400px,left=400px;");}
            </script>
            <table style="width:100%;padding:10px;margin-top:20px;">
                <td align="center" style="width:25%;padding:10px;" onclick="return absensi_karyawan('snapshot')"><a tooltip='Absensi Karyawan' flow='right'><i class="fa fa-clock-o" style="color:orange;font-size:27px;"></i></a><br>Absensi</td>
                <td align="center" style="width:25%;padding:10px;"><a href="penjualan-produk?kategori_cust=UMUM" tooltip='Buat Transaksi Baru Umum' flow='left'><i class="fa fa-shopping-cart" style="color:green;font-size:27px;"></i></a><br>Umum</td>
                <td align="center" style="width:25%;padding:10px;"><a href="penjualan-produk?kategori_cust=RESEP" tooltip='Buat Transaksi Baru Resep Dokter' flow='left'><i class="fa fa-file-text-o" style="color:green;font-size:27px;"></i></a><br>Resep</td>
                <td align="center" style="width:25%;padding:10px;" onclick="return lap_penjualan_produk('lap-penjualan-produk')"><a tooltip='Laporan Penjualan' flow='left'><i class="fa fa-print" style="color:purple;font-size:27px;"></i></a><br>Slip Setor</td>
            </table>
        </td></tr>
    </table>
    </td></table>
</td>