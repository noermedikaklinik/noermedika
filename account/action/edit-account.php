<?php
    require "../akses.php";
    $id_user           = strtoupper($_POST['id_user']);
    $username          = strtoupper($_POST['username']);
    $nama              = ucwords($_POST['nama']);
    $alamat            = ucwords($_POST['alamat']);
    $email             = strtolower($_POST['email']);
    $hp                = $_POST['hp'];
    $jabatan           = strtoupper($_POST['jabatan']);
    $jenis_kelamin     = strtoupper($_POST['jenis_kelamin']);
    $image             = $_POST['image'];
    $doc1              = $_FILES['doc1']['name'];
    $ukuran            = $_FILES['doc1']['size'];
    $ekstensi          = array('png','jpg','jpeg');
    
    if ($doc1 <> "")
    {
    $ext1 = pathinfo($doc1, PATHINFO_EXTENSION);
    if(!in_array($ext1,$ekstensi) ) { header ("Location:edit-user-account?message=Extension Not Allowed&&alert=alert alert-danger");
    }
    else
      {
        if ($ukuran < 1110440700)
        {		
            $filename = $id_user.'_'.$doc1;
            move_uploaded_file($_FILES['doc1']['tmp_name'], '../staff-image/'.$id_user.'_'.$doc1);
    $hapus = "../staff-image/$image";
    unlink ($hapus);
    $SQL = "UPDATE db_user SET foto='$filename' where id_user='$id_user'";
    mysqli_query($koneksi,$SQL) or die (include "error-message.php");
    }
    }
    $SQL = "UPDATE db_user SET username='$username', nama='$nama', hp='$hp', alamat='$alamat', email='$email', jenis_kelamin='$jenis_kelamin', jabatan='$jabatan' where id_user='$id_user'";
    mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    header("location:../edit-user-account?message=User Account Changed&id_user=$id_user&alert=alert alert-success");
    }
    if ($doc1 == "")
    {
    $SQL = "UPDATE db_user SET username='$username', nama='$nama', hp='$hp', alamat='$alamat', email='$email', jenis_kelamin='$jenis_kelamin', jabatan='$jabatan' where id_user='$id_user'";
    mysqli_query($koneksi, $SQL) or die (include "error-message.php");
    header("location:../edit-user-account?message=User Account Changed&id_user=$id_user&alert=alert alert-success");
    }
?>