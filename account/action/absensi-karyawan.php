<?php
    require_once "../akses.php";
    $status = $_POST['status'];
    $img    = $_POST['image'];
    $tglnow    = date("Y-m-d");
    $jamnow = date("H:i:s");
    $folderPath = "../foto-absensi/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        
    $SQL = "INSERT INTO db_absensi (tanggal,jam,id_user,foto,status)
    VALUES ('$tglnow','$jamnow','$akses[id_user]','$fileName','$status')";
    mysqli_query($koneksi, $SQL) or die (mysqli_error());

    echo "<br><br><br><br><center>ABSENSI BERHASIL, TERIMA KASIH</center>";exit;
        
?>