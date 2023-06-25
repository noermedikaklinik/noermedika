<table id="myTable" style="width:100%;padding:10px;margin-top:0px;">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:55%;padding:10px;">Nama Barang / Items</th>
    <th style="width:15%;padding:10px;">Harga Satuan</th>
    <th style="width:10%;padding:10px;"><center>Qty</center></th>
    <th style="width:15%;padding:10px;">Sub Total</th>
    <th style="width:5%;padding:10px;"><center>Batal</center></th>
  </tr>

<?php
  if($kode_trx!=null&& !$kode_trx.trim().isEmpty()){
    $query=mysqli_query($koneksi, "SELECT * FROM db_penjualan where kode_trx like '$kode_trx' and status like '0' and id_user like '$akses[id_user]' order by no desc");
    $no = 0;
    while ($record=mysqli_fetch_array($query)){
    $no++;
    $sub_total_itemrp    = number_format($record["sub_total_jual"],0,",",".");
    $harga_jual_itemrp   = number_format($record["harga_jual"],0,",",".");
    
    echo "
    <script type='text/javaScript'>
    function batalkan_transaksi$no()
    {
        tanya = confirm('Anda Yakin Membatalkan Transaksi ?');
        if (tanya == true) return account_list();
        else return false;
    }
    </script>
    
    <tr>
    <td style='border:1px solid #d1d1d1;padding:10px;'><center>$no</center></td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>$record[item]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $harga_jual_itemrp</td>
    <td align='center' style='border:1px solid #d1d1d1;padding:10px;'>$record[qty]</td>
    <td style='border:1px solid #d1d1d1;padding:10px;'>Rp. $sub_total_itemrp</td>
    <td align='center' style='border:1px solid #d1d1d1;padding:10px;'><a href='action/del-trx-item?no=$record[no]&kode_trx=$kode_trx' tooltip='Batalkan Transaksi Item' flow='left' ><i class='fa fa-times' style='color:red;font-size:18px;' onclick='return batalkan_transaksi$no();'></i></a></td>
    </tr>";
  }
}

?>
</table>