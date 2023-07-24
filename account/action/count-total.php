<?php
    $total = 0;
    $totalProdukQuery = "SELECT SUM(sub_total) as total FROM db_penjualan where status = 0";
    $totalProduk = mysqli_query($koneksi, $totalProdukQuery);
    $total = mysqli_fetch_array($totalProduk)["total"];

    //add harga pemeriksaan
    $selectQuery = "SELECT SUM(d.harga) as total FROM
    db_pendaftaran_tindakan pt
    INNER JOIN db_pendaftaran p on p.no = pt.id_pendaftaran
    INNER JOIN db_dokter d on d.no = pt.id_dokter
    WHERE p.is_paid = 1";
    $resultPemeriksaan = mysqli_query($koneksi, $selectQuery);
    $totalPemeriksaan = mysqli_fetch_array($resultPemeriksaan)["total"];
    $total = $total+$totalPemeriksaan;
    $ppn = ceil(($total*11/100)/1000)*1000;
    $grand_total = $total+$ppn;
?>