<?php
    include "../akses.php";

    $id_produk         = strtoupper($_POST['id_produk']);
    $id_supplier       = strtoupper($_POST['id_supplier']);
    $nama_produk       = strtoupper($_POST['nama']);
    $kategori_produk   = strtoupper($_POST['kategori']);
    $satuan_produk     = strtoupper($_POST['satuan']);
    $harga_beli        = preg_replace("/[^0-9]/", "", $_POST['harga_beli']);
    $harga_jual        = preg_replace("/[^0-9]/", "", $_POST['harga_jual']);
    $min_stok          = preg_replace("/[^0-9]/", "", $_POST['min_stok']);

    $doc1              = $_FILES['doc1']['name'];
    $ukuran            = $_FILES['doc1']['size'];
    $ext1              = pathinfo($doc1, PATHINFO_EXTENSION);
    $ekstensi          =  array('png','jpg','jpeg','gif');

    if ($doc1 <> "")
    {
        $ext1 = pathinfo($doc1, PATHINFO_EXTENSION);
        if(!in_array($ext1,$ekstensi) ) { 
            header ("Location:../edit-product?message=Extension Not Allowed&&alert=alert alert-danger");
        }
        else
        {
            if ($ukuran < 1110440700)
            {
                $select_data = mysqli_query($koneksi, "SELECT foto from db_produk where id_produk='$id_produk'");
                $image     = mysqli_fetch_assoc($select_data);
                $filename = $id_produk.'_'.$doc1;
                move_uploaded_file($_FILES['doc1']['tmp_name'], '../produk-image/'.$id_produk.'_'.$doc1);
                $hapus = "produk-image/$image";
                unlink ($hapus);
                $SQL = "UPDATE db_produk SET foto='$filename' where id_produk='$id_produk'";
                mysqli_query($koneksi, $SQL) or die (include "error-message.php");
            }
        }
        $SQL = "UPDATE db_produk SET nama_produk='$nama_produk', kategori_produk='$kategori_produk', satuan_produk='$satuan_produk', harga_beli='$harga_beli', harga_jual='$harga_jual', min_stok='$min_stok', foto='$filename', id_supplier='$id_supplier' where id_produk='$id_produk'";
        mysqli_query($koneksi,$SQL) or die (include "error-message.php");
    }
    if ($doc1 == "")
    {
        $SQL = "UPDATE db_produk SET nama_produk='$nama_produk', kategori_produk='$kategori_produk', satuan_produk='$satuan_produk', harga_beli='$harga_beli', harga_jual='$harga_jual', min_stok='$min_stok', id_supplier='$id_supplier' where id_produk='$id_produk'";
        mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    }
    header("location:../edit-product?message=Data produk berhasil diupdate&id_produk=$id_produk&alert=alert alert-success");
?>