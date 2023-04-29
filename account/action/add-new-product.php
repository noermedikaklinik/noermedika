<?php
require("../../configuration/koneksi.php");
$id_produk = strtoupper($_POST['id_produk']);
$result1   = mysqli_query($koneksi, "SELECT * FROM db_produk where id_produk like '$id_produk'");
$produk    = mysqli_num_rows($result1);
if ($produk >= "1"){ header ("Location:../add-new-product?message=Kode barang telah terdaftar, silahkan gunakan kode barang lainnya&alert=alert alert-danger"); exit;}

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
if(!in_array($ext1,$ekstensi) ) { 
    header ("Location:add-new-product?message=Extension gambar ditolak&&alert=alert alert-danger");
}
else
  {
	if ($ukuran < 1110440700)
	{		
		$filename = $id_produk.'_'.$doc1;
		move_uploaded_file($_FILES['doc1']['tmp_name'], '../produk-image/'.$id_produk.'_'.$doc1);
		
		$SQL = "INSERT INTO db_produk (id_produk,nama_produk,kategori_produk,satuan_produk,harga_beli,harga_jual,min_stok,foto,id_supplier)
		VALUES ('$id_produk','$nama_produk','$kategori_produk','$satuan_produk','$harga_beli','$harga_jual','$min_stok','$filename','$id_supplier')";
		mysqli_query($koneksi, $SQL) or die (mysql_error());
		header("location:../add-new-product?message=Produk baru berhasil ditambahkan&alert=alert alert-success"); exit;
	}
	else
	{
	    header ("Location:../add-new-product?message=Ukuran gambar terlalu besar&alert=alert alert-warning");
	}
  }
?>