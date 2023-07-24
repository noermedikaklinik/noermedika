<?php
    require_once dirname(__DIR__)."/akses.php";
    $size = isset($_GET['size'])?$_GET['size']:20;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $filter = isset($_GET['filter'])?$_GET['filter']:"";
    $where = isset($_GET['filter'])?"where id_produk like '%$filter%' or nama_produk like '%$filter%'":"";
	$data_produk= mysqli_query($koneksi,"select * from db_produk $where");
    $count = mysqli_num_rows($data_produk);
    if($halaman > 1){
        
        echo "<button id = 'first-button' class='pagination-button'>first page</button>";
        echo "<button id='prev-button' class='pagination-button'>prev</button>";
    }
    echo "<button class='pagination-button' disabled>$halaman</button>";
    if($halaman < $count){
        echo "<button id = 'next-button' class='pagination-button'>next</button>";
        echo "<button id = 'last-button' class='pagination-button'>last page</button>";
    }
?>