<?php 
$id_user = $akses['id_user'];
$sqlpengunjung    = "select sum(sub_total_jual) kunjung from db_penjualan where id_user = '$id_user' and status like '1' and status_setor like '0' and jenis_pembayaran like 'CASH'";
$resultpengunjung = mysqli_query($koneksi,$sqlpengunjung);
$pengunjung3      = mysqli_fetch_object($resultpengunjung);
$user_trx      = $pengunjung3->kunjung;
$user_trxrp    = number_format($user_trx,0,",",".");
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Klinik Noer Medika Samarinda</title>
        <link rel="shortcut icon" href="../assets/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../link/mystyle.css?<?php echo date('m/d/Y h:i:s a', time());?>" />
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-grid.css"/>
        <script type="text/javascript">$(window).load(function() { $("#loading").fadeOut("slow"); })</script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="../link/jquery.fancybox.css">
<script src="../link/jquery.fancybox.js"></script>
<script type="text/javascript">$("[data-fancybox]").fancybox({ });</script>

<div id="loading"></div>

<div id="header">
<table style="width:100%;height:80px;padding:10px;background:#ffffff;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);">
    <td style="width:20%;">
        <table width="100%">
            <td width="40%" align="center"><img src="../assets/header.jpg" style="width:150px;auto;border-radius:5px;"></td>
        </table>
    </td>
    
    <td width="10%">&nbsp;</td>

    <td align="right" style="width:60%;">
         <table style="padding:20px;background:white;width:95%;height:40px;border:3px solid;">
             
             <td width="10%" align="center" class="link">
                    <div class="dropdown">
                    <span style="font-size:11px"><i class="fa fa-file-text" style="color:#1d3565;font-size:12px;"></i> PERSEDIAAN</span>
                    <div class="dropdown-content" align="left">
                      <a href="list-produk" style="text-decoration:none;color:black;font-size:12px;">DATA BARANG</a>
                      <a href="list-jasa" style="text-decoration:none;color:black;font-size:12px;">DATA PRODUK JASA</a>
                      <!--<a href="add-stock-produk" style="text-decoration:none;color:black;font-size:12px;">TAMBAH PERSEDIAAN</a>-->
                      <a href="list-stock-min" style="text-decoration:none;color:black;font-size:12px;">PERSEDIAAN MINIMUM</a>
                    </div>
                  </div> 
             </td> 
             
             <td width="10%" align="center" class="link">
                    <div class="dropdown">
                    <span style="font-size:11px"><i class="fa fa-users" style="color:#1d3565;font-size:12px;"></i> PARTNER</span>
                    <div class="dropdown-content" align="left">
                      <a href="konsulen-list" style="text-decoration:none;color:black;font-size:12px;">KONSULEN</a>
                      <a href="supplier-list" style="text-decoration:none;color:black;font-size:12px;">SUPPLIER</a>
                    </div>
                  </div> 
             </td> 

             <td width="10%" align="center" class="link">
                   <div class="dropdown">
                    <span style="font-size:11px"><i class="fa fa-file" style="color:#1d3565;font-size:12px;"></i> TRANSAKSI</span>
                     <div class="dropdown-content" align="left">
                      <a href="list-nota" style="text-decoration:none;color:black;font-size:12px;">DATA NOTA</a>
                      <a href="lap-penjualan-global" style="text-decoration:none;color:black;font-size:12px;">PENJUALAN GLOBAL</a>
                      <a href="keuangan" style="text-decoration:none;color:black;font-size:12px;">KEUANGAN</a>
                     </div>
                    </div>
             </td>
             
             <td width="10%" align="center" class="link">
                   <div class="dropdown">
                    <span style="font-size:11px"><i class="fa fa-user" style="color:#1d3565;font-size:12px;"></i> AKUN LIST</span>
                     <div class="dropdown-content" align="left">
                      <a href="account-list" style="text-decoration:none;color:black;font-size:12px;">DATA KARYAWAN</a>
                      <a href="my-account" style="text-decoration:none;color:black;font-size:12px;">AKUN SAYA</a>
                     </div>
                    </div>
             </td>
            
             <td width="10%" align="center" class="link"><a href="logout" style="text-decoration:none;background:none;color:black;font-size:11px;"><i class="fa fa-sign-out" style="color:#1d3565;font-size:16px;"></i> LOGOUT</a></td>
             
         </table>
    </td></tr>
</table>
</div>

<script src="../link/myjs.js"></script>
<div class="wrapper">
<?php
if(isset($_GET['alert'])){
    
  $alert   = $_GET['alert'];
  $message = $_GET['message'];
  if ($message <> "")
  {
    ?>
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);
        });    
    </script>

    <div class="container-message">
        <div class="<?php echo "$alert"; ?>" role="alert">
        <center><?php echo "$message"; ?></center>
        </div>
    </div>
    <?php 
  } 
}
?>