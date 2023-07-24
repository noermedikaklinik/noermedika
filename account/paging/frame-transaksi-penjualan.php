<table id="myTable" style="width:100%;padding:10px;margin-top:0px;" class="mt-5">
    <tr class="header" height="35" style="background:#1d3565;color:white;">
    <th style="width:5%;padding:10px;"><center>No</center></th>
    <th style="width:55%;padding:10px;">Nama Barang / Items</th>
    <th style="width:15%;padding:10px;">Harga Satuan</th>
    <th style="width:10%;padding:10px;"><center>Qty</center></th>
    <th style="width:15%;padding:10px;">Sub Total</th>
    <th style="width:5%;padding:10px;"><center>Batal</center></th>
  </tr>

<?php
    $query=mysqli_query($koneksi, "SELECT * FROM db_penjualan where status = 0 order by no desc") or die(mysqli_error($koneksi));
    $no = 0;
    while ($record=mysqli_fetch_array($query)){
    $no++;
    $sub_total_itemrp    = number_format($record["sub_total"],0,",",".");
    $harga_jual_itemrp   = number_format($record["harga"],0,",",".");
    
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
    <td ><center>$no</center></td>
    <td >$record[item]</td>
    <td >Rp. $harga_jual_itemrp</td>
    <td align='center' >$record[qty]</td>
    <td >Rp. $sub_total_itemrp</td>
    <td align='center' ><a href='action/del-trx-item?no=$record[no]&kode_trx=$kode_trx' tooltip='Batalkan Transaksi Item' flow='left' ><i class='fa fa-times' style='color:red;font-size:18px;' onclick='return batalkan_transaksi$no();'></i></a></td>
    </tr>";
}

?>
</table>