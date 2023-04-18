<?php
include "akses.php";
$tglnow    = date("Y-m-d");
$result1   = mysqli_query($koneksi, "SELECT * FROM db_absensi where id_user like '$akses[id_user]' and tanggal like '$tglnow' order by no desc");
$absen     = mysqli_fetch_array($result1);
if(mysqli_num_rows($result1)==0){$button_text = "CHECK IN";$button_status = "";$status = "IN";}
else if ($absen["status"] == "")   {$button_text = "CHECK IN";$button_status = "";$status = "IN";}
else if ($absen["status"] == "IN") {$button_text = "CHECK OUT";$button_status = "";$status = "OUT";}
else if ($absen["status"] == "OUT"){$button_text = "";$button_status = "disabled";$status = "";}
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <style type="text/css">
    #results { padding:10px; }
    input[type=button]{
    height:50px;
    font-size: 14px;
    background: #009973;
    color: white;
    border: white 3px solid;
    border-radius: 5px;
    padding: 12px 20px;
    cursor:pointer;
    margin-top: 0px;
    width:125px;    
    -webkit-transition: 0.5s;
    transition: 0.5s;
    }

    input[type=button]:hover{
    opacity:0.9;width:150px;
    }
    </style>
    
<FORM language="javascript" name="form1" method="post" action="action/absensi-karyawan" enctype="multipart/form-data">
<input name="jenis" type="hidden" value="absensi-karyawan">
<input name="status" type="hidden" value="<?php echo "$status"; ?>">

<table width="100%" align="center" style="border:2px solid #d1d1d1;">
<td align="center" style="border:2px solid #d1d1d1;"><div id="my_camera"></div>
<input type="hidden" name="image" class="image-tag">
</td>
<td align="center" style="border:2px solid #d1d1d1;"><div id="results" style="width:200px;height:150px;margin-top:0px;"></div></td></tr>

<td align="center" colspan="2"><input type="button" value="Take Picture" onClick="take_snapshot()"></td></tr>
</table>

<table width="100%" align="center">
    <td><button style="width:100%;height:50px;margin-top:30px;background:red;border:0px;color:white;font-weight:bold;" <?php echo "$button_status"; ?>><?php echo "$button_text"; ?></button></form></td>
</table>

<!-- Configure a few settings and attach camera -->

<script language="JavaScript">

    Webcam.set
    ({
        width: 220,
        height: 150,
        image_format: 'jpeg',
        jpeg_quality: 90
    });


    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>

 

</body>

</html>