<?php
include "mainhead.php";

if ($akses["jabatan"] <> "ADMIN"){header ("Location:index?message=You Have No Access, Please Contact Your Administrator");}

$code1 =  mt_rand(100000, 999999);
$code2 =  mt_rand(100, 999);
?>

<script>
var htmlobjek;
$(document).ready(function(){
  $("#provinsi").change(function(){
    var provinsi = $("#provinsi").val();
    $.ajax({
        url: "take-regencies.php",
        data: "provinsi="+provinsi,
        cache: false,
        success: function(msg){
            $("#kota").html(msg);
        }
    });
  });
});

$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Submitting...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Submit');

}, 10000);
});
});
</script>



<form name="login" method="post" action="save-data" enctype="multipart/form-data">
    <input type="hidden" name="jenis" value="new-dist">
    <input type="hidden" name="id_user" value="<?php echo "DIST-$code1";?>">

<div style="height:110px;"></div>

<?php
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

<div class="container" style="width:100%;">
    <div class="<?php echo "$alert"; ?>" role="alert">
    <center><?php echo "$message"; ?></center>
    </div>
</div>

<?php 
} 
?>

<table width="95%" align="center" style="background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
    <td>
<table width="95%" align="center">
<td height="40">&nbsp;</td></tr>  
<td width="100%" style="padding:10px;"><a href="mitra-list" tooltip="Kembali ke data instansi" flow="right"><i class="fa fa-arrow-left" style="color:grey;font-size:27px;"></i></a> &nbsp; &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Tambah Distributor</b></font></td>  
</table>

<div style="height:25px;"></div>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Logo</b></font>
<br><input type="file" name="doc1" required></td></tr>
</tr>
</table>


<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Login</b></font></td>
</table>

<table width="95%" align="center">
<td style="width:50%;padding:10px;">ID Distributor
<br><input type="text" value="<?php echo "DIST-$code1";?>" autocomplete="off" disabled></td>
<td style="width:50%;padding:10px;">Username
<br><input type="text" name="username" placeholder="create your own with 6 digits" value="<?php echo "DIST-$code2";?>" maxLength="6" autocomplete="off" required></td></tr>
</table>

<table width="95%" align="center">
<td style="padding:10px;"><font size="2"><b>Informasi Akun</b></font></td>
</table>


<table width="95%" align="center">
<td style="width:33%;padding:10px;">Nama
<br><input type="text" name="nama" autocomplete="off" required></td> 
<td colspan="2" style="padding:10px;">Alamat
<br><input type="text" name="alamat" autocomplete="off" required></td></tr>

<td style="width:33%;padding:10px;">Provinsi (*)
<br><select name="provinsi" id="provinsi" required>
    <option value=""></option>
            <?php 
            $qry=mysql_query("SELECT * From provinces");
            while ($t=mysql_fetch_array($qry)) {
            echo "<option value='$t[id]'>$t[name]</option>";
            }
            ?>
    </select>
</td> 
<td style="width:33%;padding:10px;">Kota/Kabupaten (*)
<br><select name="kota" id="kota" required>
    <option value=""></option>
    </select>
</td> 
<td style="width:33%;padding:10px;">Email
<br><input type="email" name="email" autocomplete="off" required>
</td></tr>





<td style="width:33%;padding:10px;">Posisi
<br><select name="jabatan" autocomplete="off" required>
    <option value="">choose position</option>
    <option value="DISTRIBUTOR">DISTRIBUTOR</option>
    </select></td> 
<td style="width:33%;padding:10px;">No Handphone
<br><input type="number" name="hp" autocomplete="off" required></td> 
<td style="width:33%;padding:10px;">Minimum Order
<br><input type="number" name="min_order" autocomplete="off" required></td></tr>
</table>




<div style="height:25px;"></div>

<table width="95%" align="center">
<td colspan="3">&nbsp;</td></tr>
<td colspan="3" align="right" style="padding:10px;"><fieldset><button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Submit</button></td></tr>
</table>

<div style="height:35px;"></div>

</td>
</table>

<div style="height:75px;"></div>


















