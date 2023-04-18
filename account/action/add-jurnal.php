<?php
    require "../akses.php";
    $trx_no      = strtoupper($_POST["trx_no"]);
    $kategori    = strtoupper($_POST["kategori"]);
    $id_akun     = strtoupper($_POST["id_akun"]);
    $trx_date    = strtoupper($_POST["trx_date"]);
    $amount      = preg_replace("/[^0-9]/", "", $_POST['amount']);
    $desk        = strtoupper($_POST["desk"]);
    $tipe        = strtoupper($_POST["tipe"]);
    $jurnalno    = strtoupper($_POST["jurnalno"]);

    $sql  = mysqli_query($koneksi, "SELECT * FROM list_akun where id like '$id_akun'") or die (mysql_error());
    $akun = mysqli_fetch_array($sql);

    if ($tipe == "DEBET")
    {
    $SQL = "INSERT INTO mutasi (no,jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('','$jurnalno','$trx_no','$trx_date','$desk','$amount','','$kategori','$akun[name]','DEBET','0','$akun[jenis_akun]')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysql_error());
    }
    if ($tipe == "KREDIT")
    {
    $SQL = "INSERT INTO mutasi (no,jurnalno,trx_no,tanggal,description,debet,kredit,kategori,nama_akun,tipe,report,jenis_akun)
    VALUES ('','$jurnalno','$trx_no','$trx_date','$desk','','$amount','$kategori','$akun[name]','KREDIT','0','$akun[jenis_akun]')";
    mysqli_query($koneksi, $SQL) or die ("Gagal query ubah : ".mysql_error());
    }

    header ("Location:../keuangan?jurnalno=$jurnalno&message=Jurnal berhasil disimpan&alert=alert alert-success");
?>